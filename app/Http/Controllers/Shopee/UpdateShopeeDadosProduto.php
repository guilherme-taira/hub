<?php

namespace App\Http\Controllers\Shopee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrayProduct;
use DateTime;

interface hubShopee{
    public function filaDeProdutos();
}

class UpdateShopeeDadosProduto implements hubShopee
{
   private $patern_id;
   private $timestamp;
   private $access_token;
   
   public function __construct($patern_id,$timestamp,$access_token)
   {
      $this->patern_id = $patern_id;
      $this->timestamp = $timestamp;
      $this->access_token = $access_token;
   }
   
   public function filaDeProdutos(){
        $produtos = TrayProduct::where('id_shopee','!=',"")->where('flag_shopee','X')->get();
        
        foreach ($produtos as $produto) {
         
         $DataInicialPromocao = DateTime::createFromFormat('Y-m-d', $produto->dataInicial);
         $DataFinalPromocao = DateTime::createFromFormat('Y-m-d', $produto->dataFinal);

         $PutAtualizaMercadoLivre = new PutAtualizaMercadoLivre();
         $PutAtualizaMercadoLivre->VerificaPromocao($produto->id_shopee, $produto->PrecoPromocional, $produto->preco, $produto->stock, $DataInicialPromocao, $DataFinalPromocao, $produto->Ativo, $produto->QTDBAIXARET, $produto->precosite, $produto->Peso,$this->getPatern_id(),$this->getTimestamp(),$this->getAccess_token());
         
         }
   }

   /**
    * Get the value of patern_id
    */ 
   public function getPatern_id()
   {
      return $this->patern_id;
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
}
