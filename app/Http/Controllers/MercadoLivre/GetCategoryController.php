<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TrayProduct;
use Illuminate\Http\Request;

define("URL_BASE_GET_CATEGORIA_MERCADOLIVRE","https://api.mercadolibre.com/items/");

interface CategoriaMercadoLivre{
    public function resource();
    public function get($resource);
}

class GetCategoryController implements CategoriaMercadoLivre
{   
    private $sku;

    public function __construct($sku)
    {
        $this->sku = $sku;
    }

    public function resource(){
        return $this->get($this->getSku());
    }

    public function get($resource){

        // ENDPOINT PARA REQUISIÇÃO 
        $endpoint = URL_BASE_GET_CATEGORIA_MERCADOLIVRE.$resource;
        

        //CURL PARA REQUISIÇÂO
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'GET');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($ch);
        curl_close($ch);
        $obj = json_decode($response);

        // GRAVA CATEGORIA DO PRODUTO NO BANCO
        //TrayProduct::where('MercadoLivreID', empty($obj->id) ? "": $obj->id)->update(['Categoria' => empty($obj->category_id) ? "" : $obj->category_id, 'thumbnail' => empty($obj->thumbnail)?"":$obj->thumbnail, 'title' => empty($obj->title)?"":$obj->title,'Tipo' => empty($obj->listing_type_id) ? "" : $obj->listing_type_id]);
        return $obj;
    }

    /**
     * Get the value of sku
     */ 
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set the value of sku
     *
     * @return  self
     */ 
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }
}
