<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class AbstractCalculator{

    private Implementador $implementador; // bridge

    public function __construct(Implementador $implementador)
    {
        $this->implementador = $implementador;
    }

    public function setImplementador($implementador){
        $this->implementador = $implementador;
    }

    public function Calcular(string $sku,float $valor, float $stock,float $peso, float $taxa){
        $this->implementador->CalculoReal($sku,$valor,$stock,$peso,$taxa);
    }
}

interface Implementador {
    public function CalculoReal(string $sku,float $valor, float $stock,float $peso, float $taxa);
    public function GetDadosProduto(string $sku);
    public function GetValueCategorie(string $categoria,string $tipo);
    public function Frete(string $peso);
}

