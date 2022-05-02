<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxGetProdutoController extends Controller
{
    public function ajaxGetProduto(Request $request){

        $produto = Produtos::where('cod_loja',$request->referencia)->first();
        return response()->json(['imagem'=> $produto->img]);
    }
}
