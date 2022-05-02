<?php

namespace App\Http\Controllers;

use App\Models\Brinde;
use App\Models\pedidos;
use App\Models\Produtos;
use Illuminate\Http\Request;

class BrindeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brindes = Brinde::paginate(10);

        return view('Brinde.index',[
            "brindes" => $brindes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Brinde.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        $Brinde = new Brinde;
        $Brinde->referencia = $request->referencia;
        $Brinde->numeropromocao = $request->numeropromocao;
        $Brinde->quantidade = $request->quantidade;
        $Brinde->datainicial = $request->datainicial;
        $Brinde->datafinal = $request->datafinal;
        $Brinde->urlImg = $request->urlImg;
        $Brinde->Ativo = $request->Ativo;
        $result = $Brinde->save();
    
        if($result == 1){
            return redirect()->route('brindes.index')->with('msg_success',"Brinde Cadastrado com Sucesso!");
        }
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $valor = pedidos::where('referencia', $request->referencia)->get();
   
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
}
