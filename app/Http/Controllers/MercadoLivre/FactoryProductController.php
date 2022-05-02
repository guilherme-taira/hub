<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TrayProduct;
use Illuminate\Http\Request;

interface ProdutoMercadoLivre
{
    public function getIdMercadoLivre($sku);
}

class FactoryProductController implements ProdutoMercadoLivre
{
    public function getIdMercadoLivre($sku)
    {
        $produtoSku = new GetProdutosMercadoLivreController($sku, session('access_token'));
        $dados = json_encode($produtoSku->resource());
        if ($dados != "null") {
            TrayProduct::where('id_produto',$sku)->update(['MercadoLivreID' => $this->regexID($dados)]);
        }
    }

    public function regexID($dados)
    {
        $patterns = array();
        $patterns[0] = '/\[/';
        $patterns[1] = '/]/';
        $patterns[2] = '/"/';
        $replacements = array();
        $replacements[2] = '';
        $replacements[1] = '';
        $replacements[0] = '';
        return preg_replace($patterns, $replacements, $dados);
    }
}
