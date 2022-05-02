<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TokenAcesso;
use Illuminate\Http\Request;


/**
 * 
 * METHOD POST X DESENVOLVIDO POR GUILHERME TAIRA
 * 
 **/

define("URL_BASE_REFRESH_TOKEN_MERCADOLIVRE", "https://api.mercadolibre.com/oauth/token");

interface refreshToken
{
    public function resource();
    public function get($resource);
}

class RefreshTokenController implements refreshToken
{
    private $refreshToken;
    private $client_id;
    private $client_secret;
    private $dataAtual;

    public function __construct($refreshToken, \DateTime $dataAtual, $client_id = '7496054070179955', $client_secret = 'cjCbJvotYkCbJ5ql8jkH95aBYSClUMop')
    {
        $this->refreshToken = $refreshToken;
        $this->dataAtual = $dataAtual;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    public function resource()
    {
        return $this->get('?grant_type=refresh_token&client_id=' . $this->getClient_id() . '&client_secret=' . $this->getClient_secret() . '&refresh_token=' . $this->getRefreshToken());
    }

    public function get($resource)
    {
        // TESTE PARA VER SE O TOKEN ESTA EXPIRADO
        $acesso = TokenAcesso::first();
        $DataSistema = $this->getDataAtual()->format('Y-m-d H:i:s');
        if ($DataSistema > $acesso->DataModify) {
            // ENDPOINT PARA REQUISAO;
            $endpoint = URL_BASE_REFRESH_TOKEN_MERCADOLIVRE . $resource;
    
            // CURL POST EXEC
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'content-type:application/x-www-form-urlencoded'));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $dados = json_decode($response);
            // GRAVA OS DADOS DE ACESSO!
            $this->getDataAtual()->modify('+6 hours');
            TokenAcesso::where('user_id','451630383')->update(['access_token' => $dados->access_token,'DataModify' => $this->getDataAtual()->format('Y-m-d H:i:s')]);
            session(['access_token' => $dados->access_token]);    
        }
    }

    /**
     * Get the value of refreshToken
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set the value of refreshToken
     *
     * @return  self
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get the value of client_id
     */
    public function getClient_id()
    {
        return $this->client_id;
    }

    /**
     * Set the value of client_id
     *
     * @return  self
     */
    public function setClient_id($client_id)
    {
        $this->client_id = $client_id;

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
     * Get the value of dataAtual
     */
    public function getDataAtual()
    {
        return $this->dataAtual;
    }

    /**
     * Set the value of dataAtual
     *
     * @return  self
     */
    public function setDataAtual($dataAtual)
    {
        $this->dataAtual = $dataAtual;

        return $this;
    }
}
