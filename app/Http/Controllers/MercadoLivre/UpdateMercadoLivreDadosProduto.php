<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TrayProduct;
use DateTime;
use Illuminate\Http\Request;

class UpdateMercadoLivreDadosProduto extends Controller
{

    public function AtualizaProduto()
    {
        $i = 0;
        $array = [];
        // INSTANCIA DO BANCO 
        $produtos = TrayProduct::WHERE('FlagMercadoLivre', 'X')->where('AtivoHub', '1')->limit(5)->get();
        foreach ($produtos as $produto) {
            $DataInicialPromocao = DateTime::createFromFormat('Y-m-d', $produto->dataInicial);
            $DataFinalPromocao = DateTime::createFromFormat('Y-m-d', $produto->dataFinal);

            $FactoryProduto = new PutAtualizaMercadoLivre();
            print_r($FactoryProduto->VerificaPromocao($produto->MercadoLivreID, $produto->PrecoPromocional, $produto->preco, $produto->stock, $DataInicialPromocao, $DataFinalPromocao, $produto->Ativo, $produto->QTDBAIXARET, $produto->precosite, $produto->Peso));
            TrayProduct::where('MercadoLivreID', $produto->MercadoLivreID)->update(['FlagMercadoLivre' => '']);
            $array[$i] = $produto;
            $i++;
        }

        return $array;
    }
}
