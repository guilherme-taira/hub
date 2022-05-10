<?php
namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\Produtos;
use App\Models\TrayProduct;
use Illuminate\Http\Request;


abstract class FactoryShopee
{
    public abstract function CadastraBancoMercadoLivre($apikey);
    public abstract function GravaMercadoLivreProduro($referencia,$preco,$MercadoLivreID,$thumbnail,$Peso,$descricao,$largura,$altura,$comprimento);
    public abstract function FilaAssincrona();
}

class AnaliseDeDadosFactory extends FactoryShopee
{

    public function CadastraBancoMercadoLivre($apikey)
    {

        $MercadolivreImplements = new MercadolivreImplements($apikey);
        $dadosProduto =  $MercadolivreImplements->resource();

        $json = json_decode($dadosProduto);

        if (is_object($json) && !isset($json->retorno->erros[0]->erro->cod)) {
            foreach ($json->retorno->produtos as $produto) {
                // VARIAVEIS QUE SERÂO ARMAZENDAS

                $referencia = $produto->produto->codigo;
                $MercadoLivreID = isset($produto->produto->produtoLoja->idProdutoLoja) ? $produto->produto->produtoLoja->idProdutoLoja : "";
                $preco = isset($produto->produto->preco) ? $produto->produto->preco : "";
                $thumbnail = isset($produto->produto->imageThumbnail) ? $produto->produto->imageThumbnail : "";
                $Peso = isset($produto->produto->pesoLiq) ? floatval(($produto->produto->pesoLiq * 1000)) : "";
                $descricao = isset($produto->produto->descricao) ? $produto->produto->descricao : "";
                $largura = isset($produto->produto->larguraProduto) ? $produto->produto->larguraProduto : "1";
                $altura = isset($produto->produto->alturaProduto) ? $produto->produto->alturaProduto : "1";
                $comprimento = isset($produto->produto->profundidadeProduto) ? $produto->produto->profundidadeProduto : "1";
                // FIM VARIAVEIS

                // VALIDA SE JÁ EXISTE NO BANCO
                $Validacao = TrayProduct::where('MercadoLivreID', $MercadoLivreID)->first();
                $verificardor = empty($Validacao) ? 1 : $Validacao->MercadoLivreID;
                if ($verificardor == 1) {
                    if (!empty($MercadoLivreID)) {
                        // GRAVA NO BANCO SE TIVER VAZIO O ID MERCADO LIVRE
                        $this->GravaMercadoLivreProduro($referencia,$preco,$MercadoLivreID,$thumbnail,$Peso,$descricao,$largura,$altura,$comprimento);
                        try {
                            TrayProduct::where('referencia', $referencia)->update(['MercadoLivreID' => $MercadoLivreID, 'FlagMercadoLivre' => 'X', 'thumbnail' => $thumbnail, 'Peso' => $Peso, 'AtivoHub' => '1', 'title' => $descricao, 'largura' => $largura, 'altura' => $altura, 'comprimento' => $comprimento]);
                        } catch (\Throwable $th) {
                            echo $th->getMessage();
                        }
                    }
                }
            }
        }
    }


    public function GravaMercadoLivreProduro($referencia,$preco,$MercadoLivreID,$thumbnail,$Peso,$descricao,$largura,$altura,$comprimento)
    {
        $ExistReferencia = TrayProduct::where('referencia', $referencia)->first();
        if (!$ExistReferencia) {
            //   // GRAVA NO BANCO SE TIVER VAZIO O ID MERCADO LIVRE
            try {
                $save = new TrayProduct;
                $save->referencia = $referencia;
                $save->preco = $preco;
                $save->precosite = 0;
                $save->PrecoPromocional = 0;
                $save->stock = 0;
                $save->QTDBAIXARET = 0;
                $save->id_produto = "";
                $save->MercadoLivreID = $MercadoLivreID;
                $save->FlagMercadoLivre = '';
                $save->thumbnail = $thumbnail;
                $save->Peso = $Peso;
                $save->dataInicial = '1111-11-11';
                $save->dataFinal = '1111-11-11';
                $save->PrecoShopee = 0;
                $save->Divergente = "";
                $save->flag_estoque = "";
                $save->flag_preco = "";
                $save->DTVALIDADE = '1111-11-11';
                $save->Categoria = "";
                $save->desconto = 0;
                $save->AtivoHub = '1';
                $save->title = $descricao;
                $save->largura = $largura;
                $save->altura = $altura;
                $save->comprimento = $comprimento;
                $saved = $save->save();
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
    }

    public function FilaAssincrona(){
        $produtos = TrayProduct::where('FlagMercadoLivre','X')->get();
        foreach ($produtos as $produto) {
            
        }
    }

}
