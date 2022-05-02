<?php

namespace App\Http\Controllers;

use App\Models\LogProductModel;
use App\Models\Task;
use App\Models\TrayProduct;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// para ativar a flag do banco no tempo de execução


class TaskController extends Controller
{
    const FLAG = 'X';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $produtos = TrayProduct::paginate(10);

        if (isset($request->sku)) {
            $search_word = $request->sku;
            $produtcs = TrayProduct::where('referencia', 'LIKE', '%' . $search_word . '%')->paginate(1);

            return view('Tray.produtos', [
                'produtos' => $produtcs
            ]);
        }

        return view('Tray.produtos', [
            'produtos' => $produtos
        ]);
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
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(TrayProduct $trayProduto)
    {
        $logTray = LogProductModel::where('referencia',$trayProduto->referencia)->paginate(10);
        return view('Tray.produto', [
            'logs' => $logTray,
            'produto' => $trayProduto
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(TrayProduct $trayProduto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrayProduct $trayProduto)
    {

        $update = TrayProduct::where('id',$trayProduto->id)
        ->update(array(
            'referencia' => $request->referencia,
            'preco' => $request->preco,
            'precosite' => $request->precosite,
            'PrecoPromocional' => $request->PrecoPromocional,
            'QTDBAIXARET' =>  $request->QTDBAIXARET,
            'stock' => $request->stock,
            'dataInicial' => isset($request->dataInicial) ? $request->dataInicial : '1111-11-11',
            'dataFinal' => isset($request->dataFinal) ? $request->dataFinal : '1111-11-11',
            'flag_estoque' => SELF::FLAG,
            'flag_preco' => SELF::FLAG,
            'Ativo' =>  $request->Ativo
        ));
    
        // $update = $trayProduto->update($request->except('_token', '_method'));
        if ($update == 1) {
            return redirect()->route('trayproduct.index')->with('msg', "Produto  $request->referencia Editado com Sucesso!");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrayProduct $trayProduto)
    {
        //
    }
}
