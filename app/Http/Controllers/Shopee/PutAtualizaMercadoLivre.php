<?php

namespace App\Http\Controllers\Shopee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class ProdutoFactoryMercadoLivreFunction
{
    public abstract function VerificaPromocao($id, $Valor_promocao, $preco, $stock, \DateTimeInterface $DataInicialPromocao, \DateTimeInterface $DataFinalPromocao, $ativo, $qtdbaixa, $precosite, $peso,$patern_id,$timestamp,$access_token);
    public abstract function Dividesaldo($saldo, $qtdbaixa);
    public abstract function VerificaPrecoDiferenteLojaFiscia($precoLoja, $precoSite): float;
    public abstract function VerificaAtivo($saldo);
    public abstract function VerificaPreco($Valor);
    public abstract function GetPeso($Valor);
}


class PutAtualizaMercadoLivre extends ProdutoFactoryMercadoLivreFunction
{
    const TARIFA = 0.22;
    
    public function VerificaPromocao($id, $Valor_promocao, $preco, $stock, \DateTimeInterface $DataInicialPromocao, \DateTimeInterface $DataFinalPromocao, $ativo, $qtdbaixa, $precosite, $peso, $patern_id,$timestamp,$access_token)
    {
        $hoje = new \DateTime();
        if ($this->VerificaPreco($preco) == FALSE) {
            return false;
        } else if ($this->VerificaPreco($preco) == TRUE) {

            if ($DataFinalPromocao->format('Y-m-d') >= $hoje->format('Y-m-d') && $precosite == 0) {
                $AbstractCalculatorShopee = new AbstractCalculatorShopee(new CalculatorShopeePrice);
                $AbstractCalculatorShopee->Calcular($id, $Valor_promocao, $this->Dividesaldo($stock, $qtdbaixa), $this->GetPeso($peso), self::TARIFA,$patern_id,$timestamp,$access_token);
            } else {
                $AbstractCalculatorShopee = new AbstractCalculatorShopee(new CalculatorShopeePrice);
                $AbstractCalculatorShopee->Calcular($id, $this->VerificaPrecoDiferenteLojaFiscia($preco, $precosite), $this->Dividesaldo($stock, $qtdbaixa), $this->GetPeso($peso), self::TARIFA,$patern_id,$timestamp,$access_token);
            }
        }
    }

    public function GetPeso($Valor)
    {
        return floatval($Valor);
    }

    public function Dividesaldo($saldo, $qtdbaixa)
    {
        if ($saldo <= 1) {
            $saldo = 0;
            return $saldo;
        } else {
            if ($qtdbaixa == 0) {
                $qtdbaixa = 1;
                return ($saldo / $qtdbaixa) / 2;
            } else {
                return ($saldo / $qtdbaixa) / 2;
            }
        }
    }

    public function VerificaPrecoDiferenteLojaFiscia($precoLoja, $precoSite): float
    {
        if (floatval($precoSite <= 0)) {
            return floatval($precoLoja);
        } else {
            return floatval($precoSite);
        }
    }

    public function VerificaAtivo($Ativo)
    {
        return $Ativo;
    }

    public function VerificaPreco($Valor)
    {
        if ($Valor <= 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
