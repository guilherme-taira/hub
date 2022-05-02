<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TrayProduct;
use Illuminate\Http\Request;


class CalculadoraMercadolivreSimples implements Implementador
{
    public function CalculoReal(string $sku, float $valor, float $stock, float $peso, float $taxa)
    {
        // CHAMADA DA FUNÇÂO RETORN TIPO DE ANUNCIO E A CATEGORIA
        $Anuncio = $this->GetDadosProduto($sku);

        $tipo = $Anuncio->listing_type_id;
        $Categoria = $Anuncio->category_id;

        if ($tipo == 'gold_special') { // Clássico

            $valor_produto = $valor + $taxa;
            // DISPARO VIA API DA CATEGORIA SELECIONADA

            /**
             * ####### CHAMADA DA API PARA CATEGORIA  
             **/
            $ValueCategoria = $this->GetValueCategorie($Categoria, $tipo);
            $porcentegem_categoria = $ValueCategoria->sale_fee_amount;

            // DIVIDE O VALOR DE 100 
            $divide_porcentagem = 1 - $porcentegem_categoria;
            // CALCULO DO PRODUTO SOBRE A DIVISAO DA PORCENTAGEM
            $valor_final = ($valor_produto / $divide_porcentagem);

            if ($this->Desconto($sku) != 0) {
                $total = ((($valor_final * $this->Desconto($sku)) -  $valor_final) / 0.95);
            }else{
                $total = ($valor_final / 0.95);
            }

            // RETORNA O VALOR TOTAL
            if ($total > 79) {
                $calculoComposto = new CalculoSimples(new CalculadoraMercadoLivreFreteGratis);
                $calculoComposto->Calcular($sku, $valor, $stock, $peso, $taxa);
            } else {
                $PutProduto = new PutControllerProductController(session('access_token'), $sku, number_format($total, 2), $stock, $peso, "active");
                $PutProduto->resource();
            }
        } else if ($tipo == 'gold_pro') {

            $valor_produto = $valor + $taxa;
            // DISPARO VIA API DA CATEGORIA SELECIONADA

            /**
             * ####### CHAMADA DA API PARA CATEGORIA  
             **/
            $ValueCategoria = $this->GetValueCategorie($Categoria, $tipo);
            $porcentegem_categoria = $ValueCategoria->sale_fee_amount + 0.005;
            // DIVIDE O VALOR DE 100 
            $divide_porcentagem = 1 - $porcentegem_categoria;

            // CALCULO DO PRODUTO SOBRE A DIVISAO DA PORCENTAGEM
            $valor_final = ($valor_produto / $divide_porcentagem);

            if ($this->Desconto($sku) != 0) {
                $total = ((($valor_final * $this->Desconto($sku)) -  $valor_final) / 0.95);
            }else{
                $total = ($valor_final / 0.95);
            }

            // RETORNA O VALOR TOTAL
            if ($total > 79) {
                $calculoComposto = new CalculoSimples(new CalculadoraMercadoLivreFreteGratis);
                $calculoComposto->Calcular($sku, $valor, $stock, $peso, $taxa);
            } else {
                $PutProduto = new PutControllerProductController(session('access_token'), $sku, number_format($total, 2), $stock, $peso, "active");
                $PutProduto->resource();
            }
        }
    }


    public function GetDadosProduto(string $sku)
    {
        $dados = new GetCategoryController($sku);
        return $dados->resource();
    }

    public function GetValueCategorie(string $categoria, string $tipo)
    {
        $ValueCategoria = new CalculoCategoria($categoria, $tipo);
        return $ValueCategoria->resource();
    }

    public function Desconto($id)
    {
        $Desconto = TrayProduct::where('MercadolivreId', $id)->first();
        if ($Desconto->desconto != 0) {
            $valor = $Desconto->desconto / 100;
            return $valor;
        }
    }

    public function Frete(string $peso)
    {
        /**
         * FUNÇÂO INATIVA NESSA MODALIDADE
         * FUNÇÂO INATIVA NESSA MODALIDADE
         * **/
        // PRODUTOS COM VALOR ABAIXO DE 79 NÃO PAGA FRETE
    }
}
