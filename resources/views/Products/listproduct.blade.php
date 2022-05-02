@extends('layouts.principal')
@section('conteudo')

    <div class="container mt-4">
        <div class="card">
            <h5 class="card-header">Edição de Produto</h5>
            <div class="card-body">
                <h5 class="card-title"> {{$produto->descricao}}</h5>
                <form method="POST" action="{{route('product.update',['produto' => $produto->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputEmail4">Nome</label>
                            <input type="text" value="{{ $produto->descricao }}" name="descricao" class="form-control" id="inputEmail4"
                                placeholder="Email">
                        </div>
                        <div class="col-md">
                            <label for="inputPassword4">Preço Venda</label>
                            <input type="text" value="{{ $produto->preco_venda }}" name="preco_venda" class="form-control"
                                id="inputPassword4" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-md">
                        <label for="inputEmail4">Preço Promoção</label>
                        <input type="text" class="form-control" value="{{ $produto->preco_promocao }}" name="preco_promocional" id="inputEmail4"
                            placeholder="Email">
                    </div>
                    <div class="form-group col-md">
                        <label for="inputPassword4">SKU</label>
                        <input type="text" value="{{ $produto->sku }}" class="form-control" name="sku" id="inputPassword4"
                            placeholder="SKU">
                    </div>
                    <div class="form-group col-md">
                        <label for="inputPassword4">Categoria</label>
                        <input type="text" value="{{ $produto->categoria }}" class="form-control" name="categoria" id="inputPassword4"
                            placeholder="SKU">
                    </div>

                    <div class="form-group col-md">
                        <label for="inputPassword4">EAN / GTIN</label>
                        <input type="text" value="{{ $produto->gtin }}" class="form-control" name="gtin" id="inputPassword4"
                            placeholder="SKU">
                    </div>

                    <div class="form-group col-md">
                        <label for="exampleFormControlSelect1">Pesável</label>
                        <select class="form-control" name="pesavel" id="exampleFormControlSelect1">
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                        </select>
                    </div>

                    <div class="form-group col-md">
                        <label for="exampleFormControlSelect1">SITE</label>
                        <select class="form-control" name="envia_ecommerce" id="exampleFormControlSelect1">
                            @if($produto->envia_ecommerce == 0)
                            <option value="{{$produto->envia_ecommerce}}">NÃO</option>
                            <option value="1">SIM</option>
                            @else
                            <option value="{{$produto->envia_ecommerce}}">SIM</option>
                            <option value="0">NÃO</option>
                            @endif
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Salvar</button>
            </div>
            </form>
        </div>

       
    </div>
    </div>
@stop
