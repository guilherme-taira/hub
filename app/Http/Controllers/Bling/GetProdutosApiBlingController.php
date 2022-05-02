<?php

namespace App\Http\Controllers\Bling;

use App\Http\Controllers\Controller;
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
        return $this->get('produtos/page=70/json/');
    }

    public function get($resource)
    {

        // ENDPOINT PARA REQUISICAO
        $endpoint = URL_BASE_API_GET_PRODUTOS_BLING . $resource;
        echo $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint . '&apikey=' . $this->getApiKey() . '&estoque=S');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $produtos = json_decode($response, false);

        foreach ($produtos as $produto) {
            foreach ($produto as $valores) {

                foreach ($valores as $valor) {

                    if($valor->produto->codigo){
                        $codigo = $valor->produto->codigo;
                        $largura = $valor->produto->larguraProduto;
                        $altura = $valor->produto->alturaProduto;
                        $comprimento = $valor->produto->profundidadeProduto;
                        $produto = TrayProduct::where('referencia', $codigo)->update(['largura' => $largura, 'altura' => $altura, 'comprimento' => $comprimento]);
                        if ($produto == 1) {
                            echo "PRODUTO: $codigo | LARGURA $largura | ALTURA $altura | COMPRIMENTO $comprimento GRAVADO COM SUCESSO <hr>";
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
