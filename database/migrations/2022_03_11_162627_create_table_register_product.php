<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRegisterProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_register_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('referencia')->nullable();
            $table->float('preco')->nullable();
            $table->float('precosite')->nullable();
            $table->float('PrecoPromocional')->nullable();
            $table->date('datainicial')->nullable();
            $table->date('datafinal')->nullable();
            $table->dateTime('atualizado')->nullable();
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
        Schema::dropIfExists('table_register_product');
    }
}
