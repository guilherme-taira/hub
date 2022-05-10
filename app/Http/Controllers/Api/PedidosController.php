<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brinde;
use App\Models\TrayProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Brinde::all();
        return response()->json($produtos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $validator = Validator::make($request->all(),[
                'referencia' => 'required|min:3',
                'Ativo' => 'required|max:1|min:0',
                'datainicial' => 'required|date',
                'datafinal' => 'required|date'
        ]);  

        $errors = $validator->errors();

        if ($validator->fails()) {
            return response()->json($errors);
        }

        return Brinde::create([
            'referencia' => $request->referencia,
            'numeroPromocao' => $request->numeroPromocao,
            'quantidade' => $request->quantidade,
            'datainicial' => $request->datainicial,
            'datafinal' => $request->datafinal,
            'urlImg' => $request->urlImg,
            'Ativo' => $request->Ativo
        ]);
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
