<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TokenAcesso;
use DateTime;
use Illuminate\Http\Request;

class HubLiveController extends UpdateMercadoLivreDadosProduto
{
    public function AtivarHub()
    {
        // QTD TODAY 14/04/2022 - 4363
        $acesso = TokenAcesso::first();
        session(['access_token' => $acesso->access_token]);
        // PEGAR O ACCESS_TOKEN PARA AUTENTICAR
        $dataAtual = new DateTime();
        $refresh = new RefreshTokenController($acesso->refresh_token,$dataAtual);

        $produtos = new AnaliseDeDadosFactory();
        $produtos->CadastraBancoMercadoLivre('a0e92e1b13cad53953fa6b425bc6cb36bcf51d327ec8ca3c9a0c20d271edb3585cc96277');

        $dados = parent::AtualizaProduto();

        return view('MercadoLivre.hub',[
            'dados' => $dados
        ]);
    }
}


    