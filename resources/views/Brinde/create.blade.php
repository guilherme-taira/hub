@extends('layouts.principal')
@section('conteudo')

    <div class="container mt-4">
        <div class="card">
            <h5 class="card-header">Criar Promoção</h5>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <form method="POST" action="{{ route('brindes.store') }}">
                    @csrf

                    <div class="d-flex flex-row bd-highlight mb-3">
                        <h2 id="quantidadeVenda" class="p-2 bd-highlight"></h2>
                        <img style="width:150px; height:150px" id="imgBanco" class="p-2 bd-highlight">
                        <h2 id="Igual" class="p-2 bd-highlight"></h2>
                        <img style="width:150px; height:150px" id="brinde" class="p-2 bd-highlight">

                    </div>

                    <div id="resultadoQuery"></div>

                    <div class="form-row">

                        <div id="msgExcluir" title="Aviso">
                            Deseja Incluir Outro Produto para Receber esta Brinde?
                        </div>

                        <div class="form-group col">
                            <label for="inputEmail4">Codigo Interno / BRINDE </label>
                            <input type="text" placeholder="Digite o código interno do produto" name="referencia"
                                class="form-control" id="inputEmail4" placeholder="SKU">
                        </div>

                        <div class="col-md">
                            <label for="inputPassword4">Quantidade</label>
                            <input type="text" name="quantidade" id="quantidade" class="form-control"
                                placeholder="Quantidade">
                        </div>
                        <div class="col-md">
                            <label for="inputPassword4">Codigo Interno / RET OU TRAY</label>
                            <input type="text" name="referenciaret" id="referenciaret" class="form-control"
                                placeholder="codigo da tray ou ret">
                        </div>
                    </div>

                    <div class="col-md">
                        <label for="inputPassword4">URL Imagem</label>
                        <input type="text" name="urlImg" id="img" class="form-control"
                            placeholder="url publica da foto do produto">
                    </div>

                    <div class="col-md">
                        <label for="inputEmail4">Numero Promoção</label>
                        <input type="text" class="form-control" value="{{ uniqid('brinde') }}" name="numeropromocao"
                            id="inputEmail4" placeholder="promoção">
                    </div>

                    <div class="form-group col-md">
                        <label for="inputPassword4">Data Inicial - Promoção</label>
                        <input type="date" class="form-control" name="datainicial">
                    </div>

                    <div class="form-group col-md">
                        <label for="inputPassword4">Data Final - Promoção</label>
                        <input type="date" class="form-control" name="datafinal">
                    </div>

                    <div class="form-group col-md">
                        <label for="exampleFormControlSelect1">ATIVO</label>
                        <select class="form-control" name="Ativo" id="exampleFormControlSelect1">
                            <option value="0">NÃO</option>
                            <option value="1">SIM</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Salvar</button>
            </div>
            </form>
        </div>
    </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.theme.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>


    <script>
        $("img").hide();
        $("#imgBanco").hide();
        $("#brinde").hide();
        $("#msgExcluir").hide();

        $("#quantidade").blur(function() {
            $("#quantidadeVenda").text($("#quantidade").val() + "X");
        });

        $("#referenciaret").blur(function() {
            var referencia = $("#referenciaret").val();
            $.ajax({
                url: "/getimageajax",
                type: "GET",
                data: {
                    referencia: referencia,
                },
                success: function(response) {
                    console.log(response);
                    if (response) {
                        $("#imgBanco").show();
                        $("#imgBanco").append($("<img id='imgBanco'>"));
                        $($("img")).attr("src", response.imagem);
                        $("#Igual").text("=")
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });

        $("#img").blur(function() {
            $("#brinde").show();
            $("#brinde").append($("<img id='brinde'>"));
            $($("#brinde")).attr("src", $("#img").val());
        });



        $("form").submit(function(event) {

            $("#msgExcluir").css('position', 'relative');
            event.preventDefault();
            var msgExcluir = $("#msgExcluir");
            msgExcluir.dialog({
                modal: true,
                resizable: false,
                dialogClass: 'no-close success-dialog',
                modal: true,
                buttons: {
                    "Sim": function() {
                        alert("Salvado com Sucesso");
                        $(this).dialog('close');

                    },
                    "Não": function() {
                        alert("Salvado com Sucesso");
                        $(this).dialog('close');
                        window.location.href = '{{ route('brindes.index') }}';
                    }
                }
            });
        })
    </script>
@stop
