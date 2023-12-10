<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Horario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('horario_inicio');
            $table->dateTime('horario_fim');
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id')->on('users');
            $table->integer('id_tratamento')->unsigned();
            $table->foreign('id_tratamento')->references('id')->on('services_profession');
            $table->integer('id_funcionario')->unsigned();
            $table->foreign('id_funcionario')->references('id')->on('funcionario');
            $table->boolean('confirmado');
            $table->string('nome_cliente');
        });
            $semanaData = [
                ['id' => 1, 'name' => 'Domingo'],
                ['id' => 2, 'name' => 'Segunda Feira'],
                ['id' => 3, 'name' => 'Terça Feira'],
                ['id' => 4, 'name' => 'Quarta Feira'],
                ['id' => 5, 'name' => 'Quinta Feira'],
                ['id' => 6, 'name' => 'Sexta Feira'],
                ['id' => 7, 'name' => 'Sábado'],
            ];
            DB::table('semana')->insert($semanaData);

            $tipoUsuarioData = [
                ['id' => 1, 'name' => 'administrativo'],
                ['id' => 2, 'name' => 'funcionario'],
                ['id' => 3, 'name' => 'cliente'],
            ];
            DB::table('user_type')->insert($tipoUsuarioData);

            $sexoData = [
                ['id' => 1, 'name' => 'masculino'],
                ['id' => 2, 'name' => 'feminino'],
                ['id' => 3, 'name' => 'outro'],
            ];
            DB::table('gender')->insert($sexoData);

            $servicoData = [
                ['id' => 2, 'name' => 'funcionários', 'url' => 'funcionarios', 'id_tipo_usuario' => 1],
                ['id' => 3, 'name' => 'feriados', 'url' => 'feriados', 'id_tipo_usuario' => 1],
                ['id' => 4, 'name' => 'folgas', 'url' => 'folgas', 'id_tipo_usuario' => 1],
                ['id' => 5, 'name' => 'tratamentos', 'url' => 'tratamentos', 'id_tipo_usuario' => 1],
                ['id' => 6, 'name' => 'profissão', 'url' => 'profession', 'id_tipo_usuario' => 1],
            ];
            DB::table('servico')->insert($servicoData);
            
            Schema::create('configuracao', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome_estabelecimento')->nullable();
                $table->string('frequencia_horario')->nullable();
                $table->string('contato_estabelcimento')->nullable();
                $table->string('localizacao')->nullable();
                $table->string('email_estabelecimento')->nullable();
                $table->string('endereco')->nullable();
                $table->boolean('cliente_agendar')->nullable();
                $table->boolean('cliente_alterar_horario')->nullable();
                $table->boolean('cliente_desmarcar_horario')->nullable();
                $table->time('inicio')->nullable();
                $table->time('inicio_almoco')->nullable();
                $table->time('fim_almoco')->nullable();
                $table->time('fim')->nullable(); 
            });
//            DB::table('configuracao')->insert(['nome_estabelecimento' => 'salao','frequencia_horario' => '20','contato_estabelcimento' => '99999','localizacao' => '11','email_estabelecimento' => 'teste','endereco' => 'teste','cliente_agendar' => 'teste','cliente_alterar_horario' => 'teste','cliente_desmarcar_horario' => 'teste','inicio' => 'teste','inicio_almoco' => 'teste','fim_almoco' => 'teste','fim' => 'teste']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario');
    }
}
