<?php

namespace App\Http\Controllers\Shopee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdutctStockUpdateController implements RequestShopeeAPI
{
    const URL_BASE_AUTH_SHOPEE_UPDATE_ITEM = 'https://partner.shopeemobile.com/';

    private $partner_id;
    private $timestamp;
    private $access_token;
    private $id_product;
    private $stock;

    public function __construct(string $partner_id, string $timestamp,string $access_token,int $id_product,float $stock)
    {
        $this->partner_id = $partner_id;
        $this->timestamp = $timestamp;
        $this->access_token = $access_token;
        $this->id_product = $id_product;
        $this->stock = $stock;
    }

    public function execute(){
        return $this->get('api/v2/product/update_stock?partner_id='.$this->getPartner_id().'&timestamp='.$this->getTimestamp().'&access_token='.$this->getAccess_token().'&shop_id=436238108'.'&sign='.$this->generateSing());
    }

    public function get($resource){

        // ENDPOINT PARA REQUISICAO
        $endpoint = self::URL_BASE_AUTH_SHOPEE_UPDATE_ITEM.$resource;
    
        $data_json = array(
            "item_id" => $this->getId_product(),
            "price_list" => array([
                "original_price" => $this->getStock()],
            )
        );
       
        //print_r(json_encode( $data_json, JSON_HEX_QUOT | JSON_HEX_APOS));
        // REQUISICAO
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_json));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo "HUB V.1.0 -> Dev By Gui Taira: STATUS CODE : [" .  $httpcode . " ]" . "REF: [ {$this->getId_product()} ] ";
    }

    public function generateSing(){
        // CRIPTOGRAFA A CHAVE 
        $hmac = hash_hmac('sha256', '2003753/api/v2/product/update_price'.$this->getTimestamp().$this->getAccess_token().'436238108','10af199201d688c33a15ab04b4b1086b14b2a1bcd9c99cee36cbee3270a53185');
        return $hmac;
    }
    
    /**
     * Get the value of partner_id
     */ 
    public function getPartner_id()
    {
        return $this->partner_id;
    }

    /**
     * Get the value of timestamp
     */ 
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get the value of access_token
     */ 
    public function getAccess_token()
    {
        return $this->access_token;
    }

    /**
     * Get the value of id_product
     */ 
    public function getId_product()
    {
        return $this->id_product;
    }
    
    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }
}
