@extends('layouts.principal')
@section('conteudo')
    <div class="container mt-4">
        @if (count($produtos) <= 0)
            <div class="alert alert-danger text-center" role="alert">
                Não Há Pedidos Cadastrados!
            </div>
        @else
            <div class="list-group">
                <a href="{{ route('trayproduct.index') }}" class="list-group-item list-group-item-action active">
                    <strong> Lista de Produtos </strong>
                </a>

                <!--- MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->
                @if (session('msg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('msg') }}
                    </div>
                @endif
                <!--- FIM MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->


                <!--- BUSCA PRODUTO NO BANCO --->
                <form action="{{ route('trayproduct.index') }}" method="get" class="mt-3">
                    <div class="form-group col">
                        <label for="inputEmail4">Código Interno / SKU</label>
                        <input type="number" name="sku" class="form-control" id="inputEmail4" placeholder="Digite o SKU">
                    </div>
                </form>
                <!--- FIM BUSCA PRODUTO NO BANCO --->

                <table class="table table-hover mt-2">
                    <tr>

                        <th>CÓD INTERNO</th>
                        <th>Preço</th>
                        <th>Preço SITE</th>
                        <th>Preço Promocional</th>
                        <th>Estoque</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Promoção</th>
                        <th class="text-center">Últ Atualização</th>
                    </tr>
                    @foreach ($produtos as $product)
                        <tr>
                            <td><a class="text-decoration-none"
                                    href="{{ route('trayproduct.show', ['trayProduto' => $product->id]) }}">{{ $product->referencia }}</a>
                            </td>
                            <td>R$: {{ $product->preco }}</td>
                            <td>R$: {{ $product->precosite }}</td>
                            <td>R$: {{ $product->PrecoPromocional }}</td>
                            <td>{{ $product->stock . ' ~ ' . floatVal($product->stock) / 2 . ' (50%)' }}</td>
                            @if ($product->Ativo == 0)
                                <td><span class="badge bg-danger float-end">INATIVO</span></td>
                            @else
                                <td><span class="badge bg-success float-end">ATIVO</span></td>
                            @endif
                            @if ($product->dataFinal >= date('Y-m-d H-i-s'))
                                <td><span class="badge bg-success float-end">VIGENTE</span></td>
                            @else
                                <td><span class="badge bg-danger float-end">DESATIVADA</span></td>
                            @endif
                            <td class="text-center">{{ $product->log }}</td>
                        </tr>
                    @endforeach
                </table>
                <div class="d-flex">
                    {!! $produtos->links() !!}
                </div>
                <hr>
            </div>
        @endif
    </div>
@stop
