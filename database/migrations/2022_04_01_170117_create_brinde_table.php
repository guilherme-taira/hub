<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrindeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brinde', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('referencia')->nullable();
            $table->string('numeroPromocao')->nullable();
            $table->float('quantidade')->nullable();
            $table->date('datainicial')->nullable();
            $table->date('datafinal')->nullable();
            $table->text('urlImg')->nullable();
            $table->string('Ativo')->nullable();
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
        Schema::dropIfExists('brinde');
    }
}
