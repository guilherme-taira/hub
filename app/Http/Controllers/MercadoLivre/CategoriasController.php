<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\categorias;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = categorias::paginate(10);

        return view('MercadoLivre.categorias',[
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('MercadoLivre.categoriaStore');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validade =  Validator::make($request->except('_token'), [
            'nome' => 'required|min:6|max:30',
            'codigo' => 'required|min:7|max:12'
        ]);

        if($validade->fails()){
            return back()->withErrors($validade);
        }

        $save = new categorias();
        $save->name = $request->nome;
        $save->number = $request->codigo;
        $save->secound = $request->secound;
        $gravaBanco = $save->save();

        if($gravaBanco){
            return redirect()->route('Categories.index');
        }
      
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
}
