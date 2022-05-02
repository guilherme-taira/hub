<?php

namespace App\Http\Controllers;

use App\Models\pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(isset($request->marketplace) && isset($request->pedido)){
            $pedidos = pedidos::where('Flag_divergencia','X')
            ->where('marketplace',$request->marketplace)
            ->where('n_pedido',$request->pedido)
            ->paginate(10);

            return view('pedidos.index',[
                'pedidos' => $pedidos
            ]);

        }else if(isset($request->marketplace) || isset($request->pedido)){
            if(empty($request->marketplace)){
                $pedidos = pedidos::where('Flag_divergencia','X')
                ->where('n_pedido',$request->pedido)
                ->paginate(10);

                return view('pedidos.index',[
                    'pedidos' => $pedidos
                ]);

            }else{
                $pedidos = pedidos::where('Flag_divergencia','X')
                ->where('n_pedido',$request->pedido)
                ->paginate(10);

                return view('pedidos.index',[
                    'pedidos' => $pedidos
                ]);
            }
        
        }

        $pedidos = pedidos::where('Flag_divergencia','X')
        ->paginate(10);
    
        return view('pedidos.index',[
            'pedidos' => $pedidos
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

    public function calculaPorcentagem($a,$b){
        $porcentagem = $a * 0.18;
        $total = $a - $porcentagem;
        return number_format($total,2);
    }
}
