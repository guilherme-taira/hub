<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TokenAcesso;
use DateTime;
use Illuminate\Http\Request;

interface InterfaceCategory
{
    public function GetCategory($id);
}

class GetCategoryInterfaceController implements InterfaceCategory
{

    public function GetCategory($id)
    {
        $acesso = TokenAcesso::first();
        $dataAtual = new DateTime();
        $refresh = new RefreshTokenController($acesso->refresh_token, $dataAtual);
        $refresh->resource();
    }
}

