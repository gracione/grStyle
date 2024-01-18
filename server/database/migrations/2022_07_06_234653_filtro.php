<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Filtro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filtro_tipo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('id_service_profession')->unsigned();
            $table->foreign('id_service_profession')->references('id')->on('service_profession');
        });
        Schema::create('filtro', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('porcentagem_tempo');
            $table->integer('id_filtro_tipo')->unsigned();
            $table->foreign('id_filtro_tipo')->references('id')->on('filtro_tipo');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filtro_tipo');
        Schema::dropIfExists('filtro');
    }
}
