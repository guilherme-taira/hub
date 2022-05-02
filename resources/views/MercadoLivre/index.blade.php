@extends('layouts.principal')
@section('conteudo')
    <div class="container mt-4">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @if (count($products) <= 0)
            <div class="alert alert-danger text-center" role="alert">
                Não Há Produtos Cadastrados!
            </div>
        @else
            <div class="list-group">
                <a href="{{ route('mercadolivre.index') }}" class="list-group-item list-group-item-action active">
                    <img src='{{ asset('/assets/img/meli.png') }}' style="width: 50px; height:50px;">
                    &nbsp; <strong>Lista de Produtos Mercado Livre </strong>
                </a>
                <!--- MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->
                @if (session('msg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('msg') }}
                    </div>
                @endif


                {{-- DIV QUE MOSTRA MENSAGEM --}}
                <div id="msgHub" class="form-group col"></div>

                <!--- FIM MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->


                <!--- BUSCA PRODUTO NO BANCO --->
                <form action="{{ route('mercadolivre.index') }}" method="get" class="mt-3">
                    <div class="form-group col">
                        <label for="inputEmail4">Código Interno / SKU</label>
                        <input type="number" name="referencia" class="form-control" id="inputEmail4" placeholder="Digite o SKU">
                    </div>
                </form>
                <!--- FIM BUSCA PRODUTO NO BANCO --->

                <table id="tabela" class="table table-hover mt-2">
                    <tr>
                        <th>SKU</th>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Mercado Livre ID</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Status</th>
                        <th>Categoria</th>
                        <th>Peso</th>
                        <th>Preço Site</th>
                        <th>Hub</th>
                    </tr>

                    @foreach ($products as $product)
                        <tr id="linha">
                            <td id="id_produto">{{ $product->id_produto }}</td>
                            <td><img src="{{ $product->thumbnail }}" title="SEM FOTO"></td>
                            <td><a class="text-decoration-none"
                                    href="{{ route('mercadolivre.show', ['id' => $product->id]) }}">{{ $product->title }}</a>
                            </td>
                            <td>{{ empty($product->MercadoLivreID) ? 'NÃO RELACIONADO' : $product->MercadoLivreID }}
                            </td>
                            <td>R$: {{ $product->preco }}</td>
                            <td>{{ $product->stock }}</td>
                            @if ($product->Ativo == 0)
                                <td><span class="badge bg-danger float-end">INATIVO</span></td>
                            @else
                                <td><span class="badge bg-success float-end">ATIVO</span></td>
                            @endif
                            <td>{{ empty($product->Categoria) ? 'SEM CATEGORIA' : $product->Categoria }}</td>
                            <td id="enviado">{{ $product->Peso }}</td>
                            <td id="enviado">{{ $product->precosite }}</td>
                            @if ($product->AtivoHub == 0)
                            <td id="enviado">{{ $product->id_produto }}</td>
                            @else
                                <td><span class="badge bg-success">ATIVO</span></td>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.theme.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {

            $("msgHub").hide();

            function botaofn(e) {

                if ($(this).find('.btn btn-success')) {
                    alert('Ativado no Hub!');
                }

                var valor = $(this).text();
                $(this).html("<button class='badge bg-success' disabled>Ativo</button>");
                let _token = $('meta[name="csrf-token"]').attr('content');
                // REQUISICAO AJAX PARA ATIVAR NO BANCO

                $.ajax({
                    url: "/posthubactive",
                    type: "POST",
                    data: {
                        sku: valor,
                        _token: _token
                    },
                    success: function(response) {
                        console.log(response);
                        // if (response) {
                        $("#msgHub").show();
                        $("#msgHub").html("<div class='alert alert-success'>" + response.titulo +
                            "<strong> Ativado No HUB </strong></div>");
                        $('#msgHub').hide(1000);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

                e.preventDefault();
            }

            var botao = document.querySelectorAll('#enviado');
            for (var i = 0; i < botao.length; i++) {
                botao[i].addEventListener('click', botaofn);
            }
            // $("#enviado").removeClass('btn btn-danger').addClass('btn btn-success').attr('value','Ativado');
        });
    </script>

@stop
