@extends('layouts.principal')
@section('conteudo')
    <div class="container mt-4">
        <img src='{{ asset('/assets/img/meli.png') }}' style="width: 100px">
        <div class="jumbotron">

            <div class="my-3 float-start">
                <div class="spinner-border text-success" style="width: 2.5rem; height: 2.5rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <h1 class="display-4">&nbsp; Hub Mercado Livre</h1>
            <hr class="my-4">
            <p>Atualizando todos seus produtos em tempo real.</p>
        </div>

        {{-- INICIO DA --}}

        @foreach ($dados as $dado)
            <ol class="list-group list-group-numbered">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <img src="{{ $dado->thumbnail }}" style="width: 60px">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ $dado->title }}</div>
                        Saldo : {{ $dado->stock }} -> ID : {{ $dado->MercadoLivreID }} -> Preço: {{ $dado->preco }} ,
                        Preço Site: {{ $dado->precosite }}, Preco Promocional : {{ $dado->PrecoPromocional }}
                    </div>
                    <span class="badge bg-success rounded-pill">Atualizado com Sucesso!</span>
                </li>
            </ol>
        @endforeach

        {{-- FIM  DA LISTAGEM --}}
    </div>

    <script>
        $(document).ready(function() {
            setInterval(function() {
                window.location.reload();
            }, 10000);
        });
    </script>

@stop
