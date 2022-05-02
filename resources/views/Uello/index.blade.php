@extends('layouts.principal')
@section('conteudo')
    <div class="container mt-4">
        @if (count(($pedidos)) <= 0)
            <div class="alert alert-danger text-center" role="alert">
                Não Há Produtos Cadastrados!
            </div>
        @else
            <div class="list-group">
                <a href="{{route('Uello.index')}}" class="list-group-item list-group-item-action active">
                    <strong> Lista de Pedidos Uello </strong>
                </a>

                <!--- MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->
                @if (session('msg'))
                    <div class="alert alert-success" role="alert">
                       {{session('msg')}}
                    </div>
                @endif
                <!--- FIM MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->


                <!--- BUSCA PRODUTO NO BANCO --->
                <form action="{{route('Uello.index')}}" method="get" class="mt-3">
                    <div class="form-group col">
                        <label for="inputEmail4">Chave da Nota Fiscal</label>
                        <input type="number" name="notafiscal" class="form-control" id="inputEmail4"
                            placeholder="Digite a chave da nota fiscal">
                    </div>
                </form>
                <!--- FIM BUSCA PRODUTO NO BANCO --->

                    <table class="table table-hover mt-2">
                        <tr>
                            <th>Etiqueta</th>
                            <th>N° Pedido</th>
                            <th>Data Pedido</th>
                            <th>Nome</th>
                            <th>Endereco</th>
                            <th>Valor Pedido</th>     
                        </tr>
                        @foreach ($pedidos as $pedido)
                           
                                <tr>
                                    <td><a class="text-decoration-none" href="{{ route('Uello.edit', ['Uello' => $pedido->id]) }}">{{ $pedido->chaveNota }}</a></td>
                                    <td>{{ $pedido->Orderid }}</td>
                                    <td>{{ $pedido->dataPedido }}</td>
                                    <td>{{ $pedido->nomeCliente }}</td>
                                    <td>{{ $pedido->endereco }}</td>
                                    <td>R$: {{ $pedido->partial_total }}</td>
                                    {{-- @if ($pedido->envia_ecommerce == 0)
                                    <td><span class="badge bg-danger float-end">INATIVO</span></td>
                                    @else
                                    <td><span class="badge bg-success float-end">ATIVO</span></td>
                                    @endif --}}
                                </tr>
                        @endforeach
                    </table>
                    <div class="d-flex">
                        {!! $pedidos->links() !!}
                    </div>
                    <hr>
            </div>
        @endif
    </div>
@stop

