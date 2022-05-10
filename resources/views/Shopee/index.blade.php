@extends('layouts.principal')
@section('conteudo')
    <div class="container mt-4">
        {{$sig}}
        {{$sig2}}
        <h2>Shopee HMAC GENERATOR</h2>

        <div class="col-md-6">
            <label for="Partner_Key" class="form-label">Partner Key</label>
            <input type="text" class="form-control" id="Partner_Key" value="{{ $dados->partner_key }}" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-2">
            <label for="Partner_Id" class="form-label">Partner Id</label>
            <input type="text" class="form-control" id="Partner_Id" value="{{ $dados->partner_id }}" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-3">
            <label for="Path" class="form-label">Path</label>
            <input type="text" class="form-control" id="Path" value="{{ $dados->path }}" required> <button id="gerador"
                class="btn btn-success mt-2">Gerar</button>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
        <div class="col-md-3">
            <label for="Timestamp" class="form-label">Timestamp</label>
            <input type="text" class="form-control" id="Timestamp" value="{{ $dados->timestamp }}" required>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
        <hr>

        <div class="col-md-6">
            <label for="result" class="form-label">Data:</label>
            <input type="text" class="form-control" id="data" required>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>

        <div class="col-md-6">
            <label for="result" class="form-label">Resultado</label>
            <input type="text" class="form-control" id="result" required>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>


        <div class="col-md-12">
            <label for="full" class="form-label">Full URL</label>
            <input type="text" class="form-control" id="full" required>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.theme.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"
integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
      
   
        // BOTAO GERADOR
        $('#gerador').click(function() {
            // encrypt = partnerId+path+timestamp - define string encrypt
            var encrypt = $('#Partner_Id').val() + $('#Path').val() + $('#Timestamp').val();

            $('#data').val(encrypt);

            //hmac encrypt partnerId+path+timestamp and set it as "sign" global variable
            var hash = CryptoJS.HmacSHA256(encrypt, $('#Partner_Key').val()).toString(CryptoJS.enc.Hex);
            $('#result').val(hash);

            $('#full').val(
                'https://partner.shopeemobile.com/api/v2/shop/auth_partner?partner_id=' +
                $('#Partner_Id').val() + '&timestamp=' + $('#Timestamp').val() + '&sign=' + $(
                    '#result').val() + '&redirect=https://www.hub.embaleme.com.br');

        });
        
        // 6f61624a464a79616a65776566767053
        // shop id = 436238108
        // auth/token/get

    });
</script>
