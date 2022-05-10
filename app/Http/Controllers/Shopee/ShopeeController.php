<?php

namespace App\Http\Controllers\Shopee;

use App\Http\Controllers\Bling\GetProdutosApiBlingController;
use App\Http\Controllers\Controller;
use App\Models\TokenAcesso;
use DateTime;
use Illuminate\Http\Request;

class ShopeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acesso = TokenAcesso::where('id','2')->first();
        session(['access_token_shopee' => $acesso->access_token]);

        $date = new DateTime();
        $timestamp = $date->format('U');
    
        // $RefreshTokenShopee = new RefreshTokenShopee('2003753',$timestamp);
        // print_r($RefreshTokenShopee->resource());
        echo "<pre>";
        $UpdateShopeeDadosProduto = new UpdateShopeeDadosProduto('2003753',$timestamp,$acesso->access_token);
        $UpdateShopeeDadosProduto->filaDeProdutos();

    
         
        // $dados = $this->converteDados('10af199201d688c33a15ab04b4b1086b14b2a1bcd9c99cee36cbee3270a53185','2003753','/api/v2/shop/auth_partner');
        // return view('Shopee.index',[
        //     "dados" => $dados,
        //     'sig' => $sig,
        //     'sig2' => $sig2
        // ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public  function converteDados(string $partner_key, string $partner_id, string $path){
        $date = new DateTime();
        $timestamp = $date->format('U');
        // CRIAÇÂO DA STRING NA COMBINAÇÂO DO PARTNER_ID + PATH + TIMESTAMP -> NESSA ORDEM
        $data = array(
            'partner_key' => $partner_key,
            'partner_id' => $partner_id,
            'path' => $path,
            'timestamp' => $timestamp
        );
        return json_decode(json_encode($data));
    }
}
