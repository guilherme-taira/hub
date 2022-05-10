<?php

namespace App\Http\Controllers\Shopee;

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

    public function Calcular(int $sku,float $valor, float $stock,float $peso, float $taxa, string $patern_id, string $timestamp,string $access_token){
        $this->implementador->CalculoReal($sku,$valor,$stock,$peso,$taxa,$patern_id,$timestamp,$access_token);
    }
}

interface Implementador {
    public function CalculoReal(string $sku,float $valor, float $stock,float $peso, float $taxa,string $patern_id,string $timestamp,string $access_token);
    public function GetDadosProduto(string $sku);
    public function GetValueCategorie(string $categoria,string $tipo);
    public function Frete(string $peso);
}

