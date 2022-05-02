<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\TrayProduct;
use Illuminate\Http\Request;

class AjaxPostActiveHubController extends Controller
{
    public function AtivaHub(Request $request){
        $produto = TrayProduct::where('id_produto',$request->sku)->first();
        TrayProduct::where("id_produto",$request->sku)->update(['AtivoHub' => 1]);
        return response()->json(['titulo'=> $produto->title]);
    }
  
}
