<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


interface CategoriaCalculoPorcentagem
{
    public function resource();
    public function get($resource);
}

class CalculoCategoria implements CategoriaCalculoPorcentagem
{
    const URL_BASE_GET_CATEGORIA_DATA  = "https://api.mercadolibre.com/sites/";

    private $categoria;
    private $tipo;

    public function __construct(string $categoria,string $tipo)
    {
        $this->categoria = $categoria;
        $this->tipo = $tipo;
    }

    public function resource()
    {
        return $this->get("MLB/listing_prices?price=1&category_id={$this->getCategoria()}&listing_type_id={$this->getTipo()}");
    }

    public function get($resource)
    {

        // ENDPOINT PARA REQUISIÇÃO
        $endpoint = self::URL_BASE_GET_CATEGORIA_DATA . $resource;

        /**
         * CURL REQUISICAO -X GET
         * **/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'content-type:application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $obj = json_decode($response);
        return $obj;
    }
    /**
     * Get the value of categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }


    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }
}
