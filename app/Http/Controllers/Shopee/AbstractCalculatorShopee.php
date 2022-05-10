<?php

namespace App\Http\Controllers\Shopee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbstractCalculatorShopee extends AbstractCalculator
{
    const TAXA  = 0.82;
    
    public function Calcular(int $sku, float $valor, float $stock, float $peso, float $taxa,string $patern_id, string $timestamp, string $access_token)
    {
        parent::Calcular($sku, $valor, $stock, $peso, self::TAXA, $patern_id, $timestamp, $access_token);
    }
}
