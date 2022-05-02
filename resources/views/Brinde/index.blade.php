@extends('layouts.principal')
@section('conteudo')
    <div class="container mt-4">
        @if (count($brindes) <= 0)
            <div class="alert alert-danger text-center" role="alert">
                Não Há Brindes Cadastrados!
            </div>
            <div class="container">
                <a href="{{ route('brindes.create') }}"><button type="button" class="btn btn-outline-success">Cadastrar Novo
                        Brinde +</button>
            </div>
        @else
            <div class="list-group">

                <a href="{{ route('brindes.index') }}" class="list-group-item list-group-item-action active">
                    <strong> Lista de Pedidos Uello </strong>
                </a>

                <!--- MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->
                @if (session('msg_success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('msg_success') }}
                    </div>
                @endif
                <!--- FIM MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->
         
                    <a href="{{ route('brindes.create') }}"><button type="button" class="btn btn-outline-success mt-2">Cadastrar
                            Novo Brinde +</button></a>
    

                <!--- BUSCA PRODUTO NO BANCO --->
                <form action="{{ route('brindes.index') }}" method="get" class="mt-3">
                    <div class="form-group col">
                        <label for="inputEmail4">Chave da Nota Fiscal</label>
                        <input type="number" name="notafiscal" class="form-control" id="inputEmail4"
                            placeholder="Digite a chave da nota fiscal">
                    </div>
                </form>
                <!--- FIM BUSCA PRODUTO NO BANCO --->

                <table class="table mt-2">
                    <tr>
                        <th>id</th>
                        <th>N° Brinde</th>
                        <th>Data Inicial</th>
                        <th>Data Final</th>
                        <th>Nome</th>
                        <th>Brinde</th>
                        <th>Quantidade</th>
                        <th>Referência RET</th>
                    </tr>
                    @foreach ($brindes as $brinde)
                        <tr>
                            <td><a class="text-decoration-none"
                                    href="{{ route('brindes.edit', ['id' => $brinde->id]) }}">{{ $brinde->id }}</a>
                            </td>
                            <td>{{ $brinde->numeroPromocao }}</td>
                            <td>{{ $brinde->datainicial }}</td>
                            <td>{{ $brinde->datafinal }}</td>
                            <td>{{ $brinde->datainicial }}</td>
                            <td><img style="width:70px;height:70px;" src="{{ $brinde->urlImg }}"></td>
                            <td>{{ $brinde->quantidade }}</td>
                            <td>{{ $brinde->referencia }}</td>
                        </tr>
                    @endforeach
                </table>
                <div class="d-flex">
                    {!! $brindes->links() !!}
                </div>
            </div>
        @endif
    </div>
@stop
