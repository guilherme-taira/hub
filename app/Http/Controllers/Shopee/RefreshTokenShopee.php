<?php

namespace App\Http\Controllers\Shopee;

use App\Http\Controllers\Controller;
use App\Models\TokenAcesso;
use DateTime;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Parser\Token;

interface RequestApiShopee{
    public function resource();
    public function get($resource); 
}

class RefreshTokenShopee implements RequestApiShopee
{
    const URL_BASE_AUTH_SHOPEE_REFRESH_TOKEN = 'https://partner.shopeemobile.com/';

    private $partner_id;
    private $timestamp;

    public function __construct(string $partner_id, string $timestamp)
    {
        $this->partner_id = $partner_id;
        $this->timestamp = $timestamp;
    }

    public function resource(){
        return $this->get('api/v2/auth/access_token/get?partner_id='.$this->getPartner_id().'&timestamp='.$this->getTimestamp().'&sign='.$this->generateSing());
    }

    public function get($resource){

        $acesso = TokenAcesso::where('id','2')->first();
        session(['access_token_shopee' => $acesso->access_token]);

        // ENDPOINT PARA REQUISICAO
        $endpoint = self::URL_BASE_AUTH_SHOPEE_REFRESH_TOKEN.$resource;
        
        $data_json = array(
            "refresh_token" => $acesso->refresh_token,
            "shop_id" => 436238108,
            "partner_id" => 2003753
        );
        
        // REQUISICAO
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_json));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($response);
        TokenAcesso::where('id','2')->update(['refresh_token' => $json->refresh_token, 'access_token' => $json->access_token]);
    }

    public function generateSing(){
        // CRIPTOGRAFA A CHAVE 
        $hmac = hash_hmac('sha256', '2003753/api/v2/auth/access_token/get'.$this->getTimestamp(),'10af199201d688c33a15ab04b4b1086b14b2a1bcd9c99cee36cbee3270a53185');
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
}
