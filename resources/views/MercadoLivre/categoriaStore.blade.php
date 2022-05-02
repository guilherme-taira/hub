@extends('layouts.principal')
@section('conteudo')
    <div class="container mt-4">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container mt-4">
            <h1>Categorias Especias <img src="{{ asset('assets/img/logos/mercadolivre.svg') }}"
                    style="width:64px; height:64px;"></h1>
            <hr>
            <form action="{{route('Categories.store')}}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label for="validationServer03" class="form-label">Nome da Categoria *</label>
                    <input type="text" class="form-control" value="Digite o Nome" name="nome" id="validationServer03"
                        aria-describedby="validationServer03Feedback" required>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        Preencha esse campo! * Obrigatório
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationServer04" class="form-label">Código da Categoria *</label>
                    <input type="text" class="form-control" value="EX: MLB0000#" name="codigo" id="validationServer04"
                        aria-describedby="validationServer04Feedback" required>
                    <div id="validationServer04Feedback" class="invalid-feedback">
                        Preencha esse campo! * Obrigatório
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Código da Categoria Secundária</label>
                    <input type="text" class="form-control" name="secundaria" placeholder="EX: MLB0000#">
                </div>
                <div class="col-12">
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
                <div id="mensagem"></div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#validationServer03').change(function(){
                if($('#validationServer03').val() === ""){
                    $('#validationServer03').addClass('is-invalid');
                }else{
                    if($('#validationServer03').find('is-invalid')){
                        $('#validationServer03').removeClass('is-invalid').addClass('is-valid');
                    }else{
                        $('#validationServer03').addClass('is-valid');
                            $('#validationServer03Feedback').addClass('valid-feedback').text('Parece Bom!');
                    }
                }
            });

            $('#validationServer04').change(function(){
                if($('#validationServer04').val() === ""){
                    $('#validationServer04').addClass('is-invalid');
                }else{
                    if($('#validationServer04').find('is-invalid')){
                        $('#validationServer04').removeClass('is-invalid').addClass('is-valid');
                    }else{
                        $('#validationServer04').addClass('is-valid');
                            $('#validationServer04Feedback').addClass('valid-feedback').text('Parece Bom!');
                    }
                }
            });
        });
    </script>
@endsection
