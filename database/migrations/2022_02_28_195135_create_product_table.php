<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gtin');
            $table->text('descricao');
            $table->float('preco_venda');
            $table->float('preco_promocao');
            $table->string('sku');
            $table->char('pesavel');
            $table->char('ativo');
            $table->char('envia_ecommerce');
            $table->float('estoque');
            $table->string('filial');
            $table->string('categoria');
            $table->dateTime('ultima_venda');
            $table->dateTime('ultima_compra');
            $table->string('foto');
            $table->float('fracao_incremento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lookas');
    }
}
