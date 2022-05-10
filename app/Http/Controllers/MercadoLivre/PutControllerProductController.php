<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

interface GetProdutosPut{
    public function resource();
    public function get($resource);
}

class PutControllerProductController extends Controller
{
    const URL_BASE_PUT_PRODUTO = "https://api.mercadolibre.com/items/";

    private $_tokenAcess;
    private $id_produto;
    private $price;
    private $stock;
    private $peso;
    private $status;

    public function __construct($_tokenAcess,$id_produto,$price,$stock,$peso,$status)
    {
        $this->_tokenAcess = $_tokenAcess;
        $this->id_produto = $id_produto;
        $this->price = $price;
        $this->stock = $stock;
        $this->peso = $peso;
        $this->status = $status;
    }

    public function resource(){
        return $this->get($this->getId_produto());
    }

    public function get($resource){

        //ENDPOINT PARA REQUISIÇÂO
        $endpoint = self::URL_BASE_PUT_PRODUTO.$resource;

        if($this->getPrice() < 79){
            $arrayDados = array(
                "price" => $this->getPrice(),
                "available_quantity" => intval($this->getStock()),
                "status" => $this->getStatus(),
                "shipping" => array(
                    "mode" => "not_specified",
                    "free_shipping" => "false",
                )
            );
        }else{
            $arrayDados = array(
                "price" => $this->getPrice(),
                "available_quantity" => $this->getStock(),
                "status" => $this->getStatus(),
            );
        }
        
        // CONVERTE O ARRAY PARA JSON
        $data_json = json_encode($arrayDados);
        
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$endpoint);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json','Accept: application/json',"Authorization: Bearer {$this->get_tokenAcess()}"]);
        $reponse = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $json = json_decode($reponse);

        //echo $httpCode . "<br>";
    }

    /**
     * Get the value of _tokenAcess
     */ 
    public function get_tokenAcess()
    {
        return $this->_tokenAcess;
    }

    /**
     * Get the value of id_produto
     */ 
    public function getId_produto()
    {
        return $this->id_produto;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of peso
     */ 
    public function getPeso()
    {
        return $this->peso;
    }
}
