<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CalculoSimples extends AbstractCalculator
{
    const TAXA_FIXA = 5.00; // TAXA FIXA POR VENDA QUANDO O VALOR É ABAIXO DE  5 REIAS

    public function Calcular(string $sku, float $valor,float $stock, float $peso,$taxa)
    {
        parent::Calcular($sku, $valor, $stock,$peso,$taxa);
    }
}
