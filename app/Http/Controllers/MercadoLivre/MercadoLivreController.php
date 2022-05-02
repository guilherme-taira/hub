<?php

namespace App\Http\Controllers\MercadoLivre;

set_time_limit(0);

use App\Http\Controllers\Bling\GetProdutosApiBlingController;
use App\Http\Controllers\Controller;
use App\Models\Produtos;
use App\Models\TokenAcesso;
use App\Models\TrayProduct;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use stdClass;
use Illuminate\Support\Facades\Validator;

class MercadoLivreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $acesso = TokenAcesso::first();
        session(['access_token' => $acesso->access_token]);
    
        // PEGAR O ACCESS_TOKEN PARA AUTENTICAR
        $dataAtual = new DateTime();
        $refresh = new RefreshTokenController($acesso->refresh_token,$dataAtual);
        print_r($refresh->resource());

        if(!empty($request->referencia)){
            $codigo = $request->referencia;
            $produtos = TrayProduct::where('referencia','LIKE','%'. $codigo .'%')->paginate(10);

            return view('MercadoLivre.index',[
                'products' => $produtos
            ]);
        }

        //REDIRECIONA PARA A VIEw
           $produtos = TrayProduct::where('MercadoLivreID','!=','')->paginate(10);
           return view('MercadoLivre.index',[
               'products' => $produtos
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
    public function show(TrayProduct $id)
    {
        return view('MercadoLivre.edit',[
            'produto' => $id
        ]);
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
    public function update(Request $request,TrayProduct $id)
    {   

        $validator = Validator::make($request->all(),
        [
            'title' => 'required|min:3',
            'desconto' => 'required|min:0',
            'largura' => 'required|min:0',
            'altura' => 'required|min:0',
            'comprimento' => 'required|min:0',
            
        ]);

        if($validator->fails()){
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $update = $id->update($request->except('_token','_method'));
  
            if($update == 1){
                return back()->with('msg',"Produto Editado Com Sucesso!");
            }
        }

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
