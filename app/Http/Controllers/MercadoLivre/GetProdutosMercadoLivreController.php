<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

define("URL_BASE_GET_PRODUCT_BY_SKU","https://api.mercadolibre.com/");

interface GetProdutosML {
    public function resource();
    public function get($resouce);
}

class GetProdutosMercadoLivreController implements GetProdutosML
{
    private $sku;
    private $access_token;
    
    public function __construct($sku,$access_token)
    {
        $this->sku = $sku;
        $this->access_token = $access_token;
    }

    public function resource(){
        return $this->get('users/451630383/items/search?sku='.$this->getSku());
    }

    public function get($resouce){

        // ENDPOINT PARA REQUISIÇÂO
        $endpoint = URL_BASE_GET_PRODUCT_BY_SKU.$resouce;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$this->getAccess_token()));
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'GET');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($ch);
        $obj = json_decode($response);
        if(!empty($obj->results)){
            return $obj->results;
        }
    }

    //stdClass Object ( [access_token] => APP_USR-7496054070179955-040518-b6a3546f7d38fd80fa07d0f1ad7cf460-451630383 [token_type] => bearer [expires_in] => 21600 [scope] => offline_access read write [user_id] => 451630383 [refresh_token] => TG-624c9132ac6995001c995bc7-451630383 )
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

    /**
     * Get the value of access_token
     */ 
    public function getAccess_token()
    {
        return $this->access_token;
    }

    /**
     * Set the value of access_token
     *
     * @return  self
     */ 
    public function setAccess_token($access_token)
    {
        $this->access_token = $access_token;

        return $this;
    }
}


