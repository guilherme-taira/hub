@extends('layouts.principal')
@section('conteudo')

    <div class="container mt-4">

        @if (session('msg'))
            <div class="alert alert-success" role="alert">
                {{ session('msg') }}
            </div>
        @endif
        {{-- Erros de Validaçao --}}
        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h5 class="card-header">{{ $produto->title }}</h5>
            <div class="card-body">
                <div class="col-md-1 float-end">
                    Foto:
                    <img src="{{ $produto->thumbnail }}" class="img-thumbnail" alt="Produto">
                </div>
                <h5 class="card-title">Referência: {{ $produto->referencia }}</h5>
                <form class="row g-3" action="{{ route('mercadolivre.update', $produto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="title" value="{{ $produto->title }}" id="nome">
                    </div>
                    <div class="col-md-6">
                        <label for="referencia" class="form-label">Referência:</label>
                        <input type="text" value="{{ $produto->referencia }}" name="referencia" class="form-control"
                            id="referencia">
                    </div>
                    <div class="col-2">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="form-control" id="preco" name="preco" disabled
                            value="{{ $produto->preco }}">
                    </div>

                    <div class="col-2">
                        <label for="precosite" class="form-label">Preço Site</label>
                        <input type="text" class="form-control" id="precosite" name="precosite" disabled
                            value="{{ $produto->precosite }}">
                    </div>

                    <div class="col-4">
                        <label for="precopromocional" class="form-label">Preço Promocional</label>
                        <input type="text" class="form-control" disabled id="precopromocional" name="PrecoPromocional"
                            value="{{ $produto->PrecoPromocional }}">
                    </div>
                    <hr>

                    <div class="col-4">
                        <label for="precopromocional" class="form-label">Data Promocional Inicial</label>
                        <input type="date" class="form-control" disabled id="precopromocional" name="dataInicial"
                            value="{{ $produto->dataInicial }}">
                    </div>

                    <div class="col-4">
                        <label for="precopromocional" class="form-label">Preço Promocional Término</label>
                        <input type="date" class="form-control" disabled id="precopromocional" name="dataFinal"
                            value="{{ $produto->dataFinal }}">
                    </div>

                    <div class="col-2">
                        <label for="desconto" class="form-label">Desconto %</label>
                        <input type="text" class="form-control" name="desconto" id="desconto"
                            value="{{ $produto->desconto }}">
                    </div>

                    <div class="col-2">
                        <label for="preco" class="form-label">ID Mercado Livre</label>
                        <input type="text" class="form-control" name="MercadoLivreID" id="preco" disabled
                            value="{{ $produto->MercadoLivreID }}">
                    </div>

                    <div class="col-2">
                        <label for="preco" class="form-label">ID Tray Commerce</label>
                        <input type="text" class="form-control" name="id_produto" id="preco" disabled
                            value="{{ $produto->id_produto }}">
                    </div>
                    <hr>
                    <div class="col-2">
                        <label for="preco" class="form-label">Peso</label>
                        <input type="text" class="form-control" id="preco" name="peso" value="{{ $produto->Peso }}">
                    </div>
                    <div class="col-2">
                        <label for="preco" class="form-label">Largura</label>
                        <input type="text" class="form-control" id="preco" name="largura"
                            value="{{ $produto->largura }}">
                    </div>

                    <div class="col-2">
                        <label for="preco" class="form-label">Altura</label>
                        <input type="text" class="form-control" id="preco" name="altura"
                            value="{{ $produto->altura }}">
                    </div>

                    <div class="col-2">
                        <label for="preco" class="form-label">Comprimento</label>
                        <input type="text" class="form-control" id="preco" name="comprimento"
                            value="{{ $produto->comprimento }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
