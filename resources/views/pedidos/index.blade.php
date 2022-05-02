@extends('layouts.principal')
@section('conteudo')
    <div class="container mt-4">
        @if (count($pedidos) <= 0)
            <div class="alert alert-danger text-center" role="alert">
                Não Há Produtos Cadastrados!
            </div>
        @else
            <div class="list-group">
                <a href="{{ route('Pedidos.index') }}" class="list-group-item list-group-item-action active">
                    <strong> Lista de Pedidos <span style="background-color:orangered; padding:5px;"> Shopee Divergências
                        </span></strong>
                </a>

                <!--- MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->
                @if (session('msg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('msg') }}
                    </div>
                @endif
                <!--- FIM MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->


                <!--- BUSCA PRODUTO NO BANCO --->
                <form action="{{ route('Pedidos.index') }}" method="get" class="mt-3">

                    <div class="row g-2">
                        <div class="col-md">
                            <label for="inputEmail4">Número do Pedido</label>
                            <input type="number" name="pedido" class="form-control" id="inputEmail4"
                                placeholder="Digite o SKU">
                        </div>
                        <div class="col-md">
                            <label for="floatingSelectGrid">MarketPlaces</label>
                            <select class="form-select" name="marketplace" id="floatingSelectGrid"
                                aria-label="Floating label select example">
                                <option value="" selected>Selecione uma das opções</option>
                                <option value="Shopee">Shopee</option>
                                <option value="Tray">Tray</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">Pesquisar</button>
                    </div>
                </form>
                <!--- FIM BUSCA PRODUTO NO BANCO --->

                <table class="table table-hover mt-2">
                    <tr>
                        <th>ID</th>
                        <th>Pedido</th>
                        <th>Interno</th>
                        <th>Total do Pedido</th>
                        <th>Valor RET</th>
                        <th>Valor Shopee</th>
                        <th>Líquido</th>
                        <th>Prejuízo / UN</th>
                        <th>Quantidade</th>
                        <th>Saldo</th>
                        <th>Saldo RET</th>
                        <th>Data Venda</th>
                        <th>Marketplace</th>
                    </tr>
                    @foreach ($pedidos as $pedido)
                        <tr
                            class="{{ $pedido->quantidade <= $pedido->saldo ? 'alert alert-success' : 'alert alert-danger' }}">
                            <td>{{ $pedido->id }}</td>
                            <td><a class="text-decoration-none"
                                    href="{{ route('Pedidos.show', ['id' => $pedido->id]) }}">{{ $pedido->n_pedido }}</a>
                            </td>
                            <td>{{ $pedido->cod_prod }}</td>
                            <td><span class="badge bg-success">R$: {{ $pedido->valor_total }}<span
                                        class="badge bg-danger"></td>
                            <td>R$: {{ $pedido->valor_produto_ret }}</td>
                            <td>R$: {{ $pedido->valor_produto }}</td>
                            <td><span class="badge bg-success">R$: {{ $pedido->total_ret }}</span></td>
                            @if (floatVal($pedido->total_ret - $pedido->valor_produto_ret) < 0)
                                <td><span class="badge bg-danger">R$:
                                        {{ $pedido->marketplace == 'Shopee' ? $pedido->total_ret - $pedido->valor_produto_ret : $pedido->valor_produto }}</span>
                                </td>
                            @else
                                <td>0</td>
                            @endif
                            <td><span class="badge bg-dark">{{ $pedido->quantidade }}</span></td>
                            <td><span class="badge bg-dark">{{ $pedido->saldo }}</span></td>
                            @if ($pedido->quantidade > $pedido->saldo)
                                <td><span class="badge bg-danger">NÃO</span></td>
                            @else
                                <td><span class="badge bg-success">SIM</span></td>
                            @endif
                            <td>{{ $pedido->dataSaida }}</td>
                            <td>{{ $pedido->marketplace }}</td>
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
