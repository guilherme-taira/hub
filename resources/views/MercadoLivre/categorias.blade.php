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

        @if (count($categories) <= 0)
            <div class="alert alert-danger text-center mt-4" role="alert">
                Não Há Categorias Cadastradas!
                <hr> <a href="{{ route('Categories.create') }}"><button type="button"
                        class="btn btn-outline-primary">Cadastrar</button> </a>
            </div>
        @else
        
            <h1>Categorias Especias <img src="{{ asset('assets/img/logos/mercadolivre.svg') }}"
                    style="width:64px; height:64px;"></h1>
            <hr>
            <!--- MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->
            @if (session('msg'))
                <div class="alert alert-success" role="alert">
                    {{ session('msg') }}
                </div>
            @endif
            <!--- FIM MENSAGEM DE CONFIRMAÇÂO DE SUCESSO --->


            <!--- BUSCA PRODUTO NO BANCO --->
            <form action="{{ route('product.index') }}" method="get" class="mt-3">
                <div class="form-group col">
                    <label for="inputEmail4">Código Interno / SKU</label>
                    <input type="number" name="sku" class="form-control" id="inputEmail4" placeholder="Digite o SKU">
                </div>
            </form>

            {{-- Botao para adcionar nova categoria --}}
            <div class="float-end mt-2"><a href="{{ route('Categories.create') }}"><button class='btn btn-success'>+ Nova
                        Categoria</button></a></div>
            <!--- FIM BUSCA PRODUTO NO BANCO --->

            <table class="table table-hover mt-2">
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th>Código ML</th>
                    <th>Secundário</th>
                </tr>
                @foreach ($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->id }}</td>
                        <td><a class="text-decoration-none"
                                href="{{ route('Categories.show', ['id' => $categorie->id]) }}">{{ $categorie->name }}</a>
                        </td>
                        <td>{{ $categorie->number }}</td>
                        <td>{{ $categorie->secound || 0 }}</td>
                    </tr>
                @endforeach
            </table>
            <div class="d-flex">
                {!! $categories->links() !!}
            </div>
            <hr>
        @endif

    </div>


    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
