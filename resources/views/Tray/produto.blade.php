@extends('layouts.principal')
@section('conteudo')
    <div class="container mt-4">
        <div class="card">
            <h5 class="card-header">Edição de Produto</h5>
            <div class="card-body">
                <h5 class="card-title"> {{ $produto->descricao }}</h5>
                <form method="POST" action="{{ route('trayproduct.update', ['trayProduto' => $produto->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputEmail4">Codigo Interno / SKU</label>
                            <input type="text" value="{{ $produto->referencia }}" name="referencia" class="form-control"
                                id="inputEmail4" placeholder="SKU">
                        </div>
                        <div class="col-md">
                            <label for="inputPassword4">Preço Venda</label>
                            <input type="text" value="{{ $produto->preco }}" name="preco" class="form-control"
                                placeholder="Preço Venda">
                        </div>
                    </div>
                    <div class="col-md">
                        <label for="inputEmail4">Preço Site</label>
                        <input type="text" class="form-control" value="{{ $produto->precosite }}" name="precosite"
                            id="inputEmail4" placeholder="Preço Site">
                    </div>
                    <div class="form-group col-md">
                        <label for="inputPassword4">Estoque</label>
                        <input type="text" value="{{ $produto->stock }}" class="form-control" name="stock"
                            id="inputPassword4" placeholder="Estoque">
                    </div>

                    <div class="form-group col-md">
                        <label for="inputPassword4">Quantidade de Baixa no RET</label>
                        <input type="text" value="{{ $produto->QTDBAIXARET }}" class="form-control" name="QTDBAIXARET"
                            id="inputPassword4" placeholder="SKU">
                    </div>

                    <div class="col-md">
                        <label for="inputEmail4">Preço Promoção</label>
                        <input type="text" class="form-control" value="{{ $produto->PrecoPromocional }}"
                            name="PrecoPromocional" id="inputEmail4" placeholder="promoção">
                    </div>

                    <div class="form-group col-md">
                        <label for="inputPassword4">Data Inicial - Promoção</label>
                        <input type="date" value="{{ $produto->dataInicial }}" class="form-control" name="dataInicial">
                    </div>

                    <div class="form-group col-md">
                        <label for="inputPassword4">Data Final - Promoção</label>
                        <input type="date" value="{{ $produto->dataFinal }}" class="form-control" name="dataFinal">
                    </div>

                    <div class="form-group col-md">
                        <label for="exampleFormControlSelect1">ATIVO</label>
                        <select class="form-control" name="Ativo" id="exampleFormControlSelect1">
                            @if ($produto->Ativo == 0)
                                <option value="{{ $produto->Ativo }}">NÃO</option>
                                <option value="1">SIM</option>
                            @else
                                <option value="{{ $produto->Ativo }}">SIM</option>
                                <option value="0">NÃO</option>
                            @endif
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Salvar</button>
            </div>
            </form>

            <table class="table table-hover mt-2">
                <tr>

                    <th>CÓD INTERNO</th>
                    <th>Preço</th>
                    <th>Preço Site</th>
                    <th>Preço Promocional</th>
                    <th>Estoque</th>
                    <th class="text-center">Data Inicial</th>
                    <th class="text-center">Data Final</th>
                    <th class="text-center">Últ Atualização</th>
                </tr>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->referencia }}</td>
                        <td>R$: {{ $log->preco }}</td>
                        <td>R$: {{ $log->precosite }}</td>
                        <td>R$: {{ $log->PrecoPromocional }}</td>
                        <td> {{ $log->stock }}</td>
                        <td> {{ $log->datainicial }}</td>
                        <td> {{ $log->datafinal }}</td>
                        <td> {{ $log->updated_at }}</td>
                    </tr>
                @endforeach
            </table>
            <div class="d-flex">
                {!! $logs->links() !!}
            </div>
        </div>
    </div>
    </div>
@stop
