<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LunchTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_time', function (Blueprint $table) {
            $table->increments('id');
            $table->time('inicio1');
            $table->time('fim1');
            $table->time('inicio2');
            $table->time('fim2');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_trabalho');
    }
}
