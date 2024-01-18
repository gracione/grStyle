<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DayOff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_off', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dia_semana');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('user');
        });
        Schema::create('semana', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('ferias', function (Blueprint $table) {
            $table->increments('id');
            $table->date('inicio');
            $table->date('fim');
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
        Schema::dropIfExists('folgas');
    }
}
