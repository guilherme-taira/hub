@extends('layouts.principal')
@section('conteudo')
<div class="container mt-4">
    @if (count(($logProduct)) <= 0)
        <div class="alert alert-danger text-center" role="alert">
            Não Há Produtos Cadastrados!
        </div>
    @else
        <div class="list-group">
            <a href="{{route('product.index')}}" class="list-group-item list-group-item-action active">
                <strong> Lista de Produtos </strong>
            </a>

            <!--- MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->
            @if (session('msg'))
                <div class="alert alert-success" role="alert">
                   {{session('msg')}}
                </div>
            @endif
            <!--- FIM MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->


            <!--- BUSCA PRODUTO NO BANCO --->
            <form action="{{route('LogProduct.index')}}" method="get" class="mt-3">
                <div class="form-group col">
                    <label for="inputEmail4">Código Interno / SKU</label>
                    <input type="number" name="referencia" class="form-control" id="inputEmail4"
                        placeholder="Digite a Referencia">
                </div>
            </form>
            <!--- FIM BUSCA PRODUTO NO BANCO --->

                <table class="table table-hover mt-2">
                    <tr>
                        <th>ID</th>
                        <th>Referencia</th>
                        <th>Preço</th>
                        <th>Preço SITE</th>
                        <th>Preço Promocional</th>
                        <th>Data Inicial</th> 
                        <th>Data Final</th>     
                    </tr>
                    @foreach ($logProduct as $log)
                       
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td><a class="text-decoration-none" href="{{ route('product.show', ['produto' => $log->id]) }}">{{ $log->refrencia }}</a>
                                </td>
                                <td>R$: {{ $log->preco }}</td>
                                <td>R$: {{ $log->precosite }}</td>
                                <td>{{ $log->datainicial }}</td>
                                <td>{{ $log->datafinal }}</td>
                                <td>{{ $log->PrecoPromocional }}</td>
                                <td>{{ $log->updated_at }}</td>
                            </tr>
                    @endforeach
                </table>
                <div class="d-flex">
                    {!! $products->links() !!}
                </div>
                <hr>
        </div>
    @endif
</div>
@stop