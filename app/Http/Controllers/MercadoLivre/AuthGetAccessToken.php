<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TokenAcesso;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use stdClass;

define("URL_BASE_AUTH_MERCADO_LIVRE_GET_ACESSO_TOKEN",'https://api.mercadolibre.com/oauth/token');

interface AcessoToken {
    public function resource();
    public function get($resource);
}

class AuthGetAccessToken implements AcessoToken
{   
    private $APPID;
    private $redirectURI;
    private $client_secret;
    private $code;
    
    public function __construct($APPID = '7496054070179955',$redirectURI = 'https://www.hub.embaleme.com.br', $code = 'TG-624ecc5b86ae74001ab56d67-451630383',$client_secret = 'cjCbJvotYkCbJ5ql8jkH95aBYSClUMop')
    {   
        $this->APPID = $APPID;
        $this->redirectURI = $redirectURI;
        $this->code = $code;
        $this->client_secret = $client_secret;
    }

    public function resource(){
        return $this->get('?grant_type=authorization_code&client_id='.$this->getAPPID().'&client_secret='.$this->getClient_secret().'&code='.$this->getCode().'&redirect_uri='.$this->getRedirectURI());
    }

    public function get($resource){

        // ENDPOINT PARA AUTENTICAR 
        $endpoint = URL_BASE_AUTH_MERCADO_LIVRE_GET_ACESSO_TOKEN.$resource;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','content-type:application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //https://auth.mercadolivre.com.br/authorization?response_type=code&client_id=7496054070179955&state=ABC1234&redirect_uri=https://www.hub.embaleme.com.br
        $response = curl_exec($ch);
        curl_close($ch);
        $dados = json_decode($response);
        
        // INCLUI 6 HORAS A MAIS PARA A PROXIMA ATUALIZACAO DO TOKEN - LIMITE MAXIMO
        // ESTIPULADO PELO MERCADO LIVRE 

        $date = new DateTime();
        $date->modify('+6 hours');
        $DataSistema = $date->format('Y-m-d H:i:s'); 

        // GRAVA OS DADOS DE ACESSO!
        $token = new TokenAcesso();
        $token->access_token = $dados->access_token;
        $token->type = $dados->token_type;
        $token->user_id = $dados->user_id;
        $token->refresh_token = $dados->refresh_token;
        $token->DataModify = $DataSistema;
        $token->save();
        // FIM 

        session(['access_token' => $dados->access_token]);    
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

    /**
     * Get the value of client_secret
     */ 
    public function getClient_secret()
    {
        return $this->client_secret;
    }

    /**
     * Set the value of client_secret
     *
     * @return  self
     */ 
    public function setClient_secret($client_secret)
    {
        $this->client_secret = $client_secret;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}


