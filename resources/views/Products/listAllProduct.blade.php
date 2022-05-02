@extends('layouts.principal')
@section('conteudo')
    <div class="container mt-4">
        @if (count(($products)) <= 0)
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
                <form action="{{route('product.index')}}" method="get" class="mt-3">
                    <div class="form-group col">
                        <label for="inputEmail4">Código Interno / SKU</label>
                        <input type="number" name="sku" class="form-control" id="inputEmail4"
                            placeholder="Digite o SKU">
                    </div>
                </form>
                <!--- FIM BUSCA PRODUTO NO BANCO --->

                    <table class="table table-hover mt-2">
                        <tr>
                            <th>SKU</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Preço Promocional</th>
                            <th>Estoque</th>
                            <th>Status</th>     
                        </tr>
                        @foreach ($products as $product)
                           
                                <tr>
                                    <td>{{ $product->sku }}</td>
                                    <td><a class="text-decoration-none" href="{{ route('product.show', ['produto' => $product->id]) }}">{{ $product->descricao }}</a>
                                    </td>
                                    <td>R$: {{ $product->preco_venda }}</td>
                                    <td>R$: {{ $product->preco_promocao }}</td>
                                    <td>{{ $product->estoque }}</td>
                                    @if ($product->envia_ecommerce == 0)
                                    <td><span class="badge bg-danger float-end">INATIVO</span></td>
                                    @else
                                    <td><span class="badge bg-success float-end">ATIVO</span></td>
                                    @endif
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

