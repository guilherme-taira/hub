<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\categorias;
use App\Models\TrayProduct;
use Illuminate\Http\Request;


class CalculadoraMercadoLivreFreteGratis implements Implementador
{

    const TAXA_FIXA = 0.00; // TAXA FIXA 
    const DIVISOR = 6000; // DIVISOR DO METRO CUBICO MERCADO LIVRE

    public function CalculoReal(string $sku,float $valor, float $stock,float $peso, float $taxa)
    {   
        // CHAMADA DA FUNÇÂO RETORN TIPO DE ANUNCIO E A CATEGORIA
        $Anuncio = $this->GetDadosProduto($sku);

        $tipo = $Anuncio->listing_type_id;
        $Categoria = $Anuncio->category_id;

        // VERIFICA CATEGORIA ESPECIAL 
        $especial = $this->SpecialCategory();
        
        if ($tipo == 'gold_special') { // Clássico

            // VERIFICA SE ESTA CONTIDO NAS CATEGORIAS ESPECIAIS
            if(in_array($Categoria,$especial)){
                $valor_produto = $valor + $this->FreteSpecial(floatval($this->CalculoCubico($sku)));
            }else{
                $valor_produto = $valor + $this->Frete(floatval($this->CalculoCubico($sku)));
            }
        
             // DISPARO VIA API DA CATEGORIA SELECIONADA

             /**
              * ####### CHAMADA DA API PARA CATEGORIA  
              **/
              $ValueCategoria = $this->GetValueCategorie($Categoria,$tipo);
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
                                     $PutProduto = new PutControllerProductController(session('access_token'),$sku,number_format($total,2),$stock,$this->CalculoCubico($sku),"active");
                                     $PutProduto->resource();
                                        
                                        

        }else if ($tipo == 'gold_pro') {
    
            if(in_array($Categoria,$especial)){
                $valor_produto = $valor + $this->FreteSpecial(floatval($this->CalculoCubico($sku)));
            }else{
                $valor_produto = $valor + $this->Frete(floatval($this->CalculoCubico($sku)));
            }
            // DISPARO VIA API DA CATEGORIA SELECIONADA

             /**
              * ####### CHAMADA DA API PARA CATEGORIA  
              **/
              $ValueCategoria = $this->GetValueCategorie($Categoria,$tipo);
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
                                    $PutProduto = new PutControllerProductController(session('access_token'),$sku,number_format($total,2),$stock,$this->CalculoCubico($sku),"active");
                                    $PutProduto->resource();
        }
        
    }


    public function GetDadosProduto(string $sku){
        $dados = new GetCategoryController($sku);
        return $dados->resource();
    }

    public function GetValueCategorie(string $categoria,string $tipo)
    {
        $ValueCategoria = new CalculoCategoria($categoria,$tipo);
        return $ValueCategoria->resource();
    }
    
    public function Frete(string $peso){
        if($peso <= 500){
            return 16.50;
        }else if($peso >= 500 && $peso <= 1000){
            return 18.45;
        }else if($peso >= 1000 && $peso <= 2000){
            return 18.95;
        }else if($peso >= 2000 && $peso <= 5000){
            return 23.45;
        }else if($peso >= 5000 && $peso <= 9000){
            return 34.95;
        }else if($peso >= 9000 && $peso <= 13000){
            return 54.95;
        }else if($peso >= 13000 && $peso <= 17000){
            return 60.95;
        }else if($peso >= 17000 && $peso <= 23000){
            return 71.45;
        }else if($peso >= 23000 && $peso <= 30000){
            return 82.45;
        }else if($peso >= 30000 && $peso <= 40000){
            return 93.45;
        }else if($peso >= 40000 && $peso <= 50000){
            return 99.95;
        }else if($peso >= 50000 && $peso <= 60000){
            return 107.45;
        }else if($peso >= 60000 && $peso <= 70000){
            return 115.45;
        }else if($peso >= 70000 && $peso <= 80000){
            return 122.95;
        }else if($peso >= 80000 && $peso <= 90000){
            return 130.95;
        }else if($peso >= 90000 && $peso <= 100000){
            return 138.45;
        }
    }

    public function FreteSpecial(string $peso){
        if($peso <= 500){
            return 25.42;
        }else if($peso >= 500 && $peso <= 1000){
            return 27.67;
        }else if($peso >= 1000 && $peso <= 2000){
            return 28.42;
        }else if($peso >= 2000 && $peso <= 5000){
            return 35.17;
        }else if($peso >= 5000 && $peso <= 9000){
            return 52.42;
        }else if($peso >= 9000 && $peso <= 13000){
            return 82.42;
        }else if($peso >= 13000 && $peso <= 17000){
            return 91.42;
        }else if($peso >= 17000 && $peso <= 23000){
            return 107.17;
        }else if($peso >= 23000 && $peso <= 30000){
            return 123.67;
        }else if($peso >= 30000 && $peso <= 40000){
            return 140.17;
        }else if($peso >= 40000 && $peso <= 50000){
            return 149.92;
        }else if($peso >= 50000 && $peso <= 60000){
            return 161.17;
        }else if($peso >= 60000 && $peso <= 70000){
            return 173.17;
        }else if($peso >= 70000 && $peso <= 80000){
            return 184.42;
        }else if($peso >= 80000 && $peso <= 90000){
            return 196.42;
        }else if($peso >= 90000 && $peso <= 100000){
            return 207.67;
        }
    }


    public function SpecialCategory(){
        $array = [];
        // CATEGORIAS 
        $categorias = categorias::all();
        $index = 0;
        foreach ($categorias as $categoria) {
            $array[$index] = $categoria->number;
            $index++;
        }
        return $array;
    }

    public function CalculoCubico($id){
        
        // CALCULO DO PESO CUBICO
        $cubico = TrayProduct::where('MercadoLivreID',$id)->first();
        $altura = $cubico->altura;
        $largura = $cubico->largura;
        $comprimento = $cubico->comprimento;

        $total = (($altura * $largura * $comprimento) / SELF::DIVISOR) * 1000;

        // VERIFICA PESO MAIOR 
        if($total < $cubico->Peso){
            return $cubico->Peso;
        }else{
            return $total;
        }
    }


    public function Desconto($id){
        $Desconto = TrayProduct::where('MercadolivreId',$id)->first();
        if($Desconto->Desconto != 0){
            $valor = $Desconto->desconto / 100;
            return $valor;
        }
        return false;
    }
}

