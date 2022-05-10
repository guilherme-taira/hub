<?php

namespace App\Http\Controllers\Shopee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Shopee\Implementador;
use App\Models\TrayProduct;
use Illuminate\Http\Request;

class CalculatorShopeePrice implements Implementador
{
    // CALCULO DA TAXA FIXA

    public function CalculoReal(string $sku,float $valor, float $stock,float $peso, float $taxa,$patern_id,$timestamp,$access_token){
        // CALCULO DA TAXA
        $total = $valor / $taxa;
        $TaxaShopee = number_format($total,2);
        // CALCULO DO PRODUTO 
        echo "HUB UPDATE PRODUCT [$sku]".PHP_EOL;
        $this->SendShopeeQueue($patern_id,$timestamp,$access_token,$sku,$TaxaShopee);
    }

    public function SendShopeeQueue($patern_id,$timestamp,$access_token,$sku,$valor){
        \App\Jobs\SendPutProductsShopee::dispatch($patern_id,$timestamp,$access_token,$sku,$valor);
    }

    public function GetDadosProduto(string $sku){
       return false;
    }

    public function GetValueCategorie(string $categoria,string $tipo){
        return false;
    }

    public function Frete(string $peso){
        return false;
    }
}
