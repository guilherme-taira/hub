<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;


// URLBASE PARA AUTENTICAR
define("URL_BASE_GET_BLING_PRODUTO", "https://bling.com.br/");


interface Bling{
    public function resource();
    public function get($resource);
}


class MercadolivreImplements implements Bling {

    private $apikey;

    public function __construct($apikey)
    {
        $this->apikey = $apikey;
    }
    
    public function resource(){
        $dataInicial = new DateTime();
        $dataFinal = new DateTime();
        $dataInicial->modify('-1 days'); // decrementa 2 dias da data atual
        $dataFinal->modify('+2 days'); // acresenta 2 dias da data atual
   
        return $this->get('Api/v2/produtos/json/'.'?apikey=' . $this->getApikey()."&loja=203874743&filters=dataInclusaoLoja[{$dataInicial->format('d/m/Y')} TO {$dataFinal->format('d/m/Y')}]");
    }

    public function get($resource){

        // ENDPOINT PARA REQUISICAO
        $endpoint = URL_BASE_GET_BLING_PRODUTO.$resource;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json','Accept:application/json']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * Get the value of apikey
     */ 
    public function getApikey()
    {
        return $this->apikey;
    }

    /**
     * Set the value of apikey
     *
     * @return  self
     */ 
    public function setApikey($apikey)
    {
        $this->apikey = $apikey;

        return $this;
    }
}