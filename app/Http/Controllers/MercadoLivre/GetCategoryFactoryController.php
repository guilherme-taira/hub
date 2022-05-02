<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TrayProduct;
use Illuminate\Http\Request;

abstract class CategoryFactory{
    public abstract function CadastrarCategoryMercadoLivre();
}

class GetCategoryFactoryController extends CategoryFactory
{
    public function CadastrarCategoryMercadoLivre()
    {
        $REFERENCIAS = TrayProduct::where('thumbnail','=','')->where('MercadoLivreID','!=','')->get();

        foreach ($REFERENCIAS as $REFERENCIA) {
            $produto = new GetCategoryController($REFERENCIA->MercadoLivreID);
            $produto->resource();
        }

    }
}
