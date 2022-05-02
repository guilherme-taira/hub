<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use stdClass;

define("URL_BASE_AUTH_MERCADO_LIVRE",'https://auth.mercadolivre.com.br/authorization?response_type=code');

interface Autentica {
    public function resource();
    public function get($resource);
}

class Auth implements Autentica
{   
    private $APPID;
    private $redirectURI;
    
    public function __construct($APPID = '7496054070179955',$redirectURI = 'https://www.hub.embaleme.com.br')
    {   
        $this->APPID = $APPID;
        $this->redirectURI = $redirectURI;
    }

    public function resource(){
        return $this->get('&client_id='.$this->getAPPID().'&redirect_uri='.$this->getRedirectURI());
    }

    public function get($resource){

        // ENDPOINT PARA AUTENTICAR 
        $endpoint = URL_BASE_AUTH_MERCADO_LIVRE.$resource;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'GET');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($ch);
        curl_close($ch);

        $obj = json_encode($response,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES |JSON_UNESCAPED_UNICODE);
        $url = substr($obj, 22);
        session(['url' => $url]);

        return redirect()->route('Mercadolivre');
    }

    /**
     * Get the value of APPID
     */ 
    public function getAPPID()
    {
        return $this->APPID;
    }

    /**
     * Set the value of APPID
     *
     * @return  self
     */ 
    public function setAPPID($APPID)
    {
        $this->APPID = $APPID;

        return $this;
    }

    /**
     * Get the value of redirectURI
     */ 
    public function getRedirectURI()
    {
        return $this->redirectURI;
    }

    /**
     * Set the value of redirectURI
     *
     * @return  self
     */ 
    public function setRedirectURI($redirectURI)
    {
        $this->redirectURI = $redirectURI;

        return $this;
    }


    public function redirectAuth(){
        return redirect()->to(session('url'))->send();
    }
}


