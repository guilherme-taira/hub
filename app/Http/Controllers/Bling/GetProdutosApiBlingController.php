<?php

namespace App\Http\Controllers\Bling;

use App\Http\Controllers\Controller;
use App\Jobs\getShopeeId;
use App\Models\TrayProduct;
use Illuminate\Http\Request;



define('URL_BASE_API_GET_PRODUTOS_BLING', "https://bling.com.br/Api/v2/");

class GetProdutosApiBlingController extends Controller
{

    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function resource()
    {
        return $this->get('produtos/page=69/json/');
    }

    public function get($resource)
    {

        // ENDPOINT PARA REQUISICAO
        $endpoint = URL_BASE_API_GET_PRODUTOS_BLING . $resource;
        echo $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint . '&apikey=' . $this->getApiKey() . '&loja=203664307');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $produtos = json_decode($response, false);
        echo "<pre>";
        foreach ($produtos as $produto) {
            foreach ($produto as $valores) {

                foreach ($valores as $valor) {

                    if ($valor->produto->codigo) {
                        $shopeeData = isset($valor->produto->produtoLoja) ? $valor->produto->produtoLoja : "";
                        if ($shopeeData) {
                            $codigo = $valor->produto->codigo;
                            // $largura = $valor->produto->larguraProduto;
                            // $altura = $valor->produto->alturaProduto;
                            // $comprimento = $valor->produto->profundidadeProduto;
                            // INICIA O JOB E JOGA NA FILA DE REQUISICAO
                            echo $shopeeData->idProdutoLoja . "<br>";
                             \App\Jobs\getShopeeId::dispatch($codigo,$shopeeData->idProdutoLoja)->delay(now()->addSeconds(2));
                        }
                    }
                }
            }
        }
    }

    /**
     * Get the value of apiKey
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set the value of apiKey
     *
     * @return  self
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }
}
