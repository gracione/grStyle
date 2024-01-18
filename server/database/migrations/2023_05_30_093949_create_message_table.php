<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('mensagens', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('remetente_id');
//            $table->unsignedBigInteger('destinatario_id');
//            $table->text('conteudo');
//            $table->timestamps();
//
//            $table->foreign('remetente_id')->references('id')->on('user');
//            $table->foreign('destinatario_id')->references('id')->on('user');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensagens');
    }
}
