<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TrayProduct;
use Illuminate\Http\Request;

abstract class ProdutoFactory{
    public abstract function GetId(); 
}

class produtomlfactorygetId extends ProdutoFactory{

    public function GetId()
    {
        $Referencias = TrayProduct::where('MercadoLivreID','=','')->get();
        foreach ($Referencias as $Referencia) {
             $produto = new FactoryProductController();
             $produto->getIdMercadoLivre($Referencia->id_produto);
        }   
    }
}