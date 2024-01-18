<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ScheduledTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_time', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('id_client')->unsigned();
            $table->foreign('id_client')->references('id')->on('user');
            $table->integer('id_service_profession')->unsigned();
            $table->foreign('id_service_profession')->references('id')->on('service_profession');
            $table->integer('id_employee')->unsigned();
            $table->foreign('id_employee')->references('id')->on('employee');
            $table->boolean('confirmed');
            $table->string('client_name');
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
                ['id' => 2, 'name' => 'employee'],
                ['id' => 3, 'name' => 'client'],
            ];
            DB::table('user_type')->insert($tipoUsuarioData);

            $sexoData = [
                ['id' => 1, 'name' => 'masculino'],
                ['id' => 2, 'name' => 'feminino'],
                ['id' => 3, 'name' => 'outro'],
            ];
            DB::table('gender')->insert($sexoData);

            $servicoData = [
                ['id' => 2, 'name' => 'funcionários', 'url' => 'employees', 'id_tipo_usuario' => 1],
                ['id' => 3, 'name' => 'feriados', 'url' => 'feriados', 'id_tipo_usuario' => 1],
                ['id' => 4, 'name' => 'folgas', 'url' => 'folgas', 'id_tipo_usuario' => 1],
                ['id' => 5, 'name' => 'tratamentos', 'url' => 'tratamentos', 'id_tipo_usuario' => 1],
                ['id' => 6, 'name' => 'profissão', 'url' => 'profession', 'id_tipo_usuario' => 1],
            ];
            DB::table('servico')->insert($servicoData);
            
            Schema::create('configuracao', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name_estabelecimento')->nullable();
                $table->string('frequencia_horario')->nullable();
                $table->string('contato_estabelcimento')->nullable();
                $table->string('localizacao')->nullable();
                $table->string('email_estabelecimento')->nullable();
                $table->string('endereco')->nullable();
                $table->boolean('client_agendar')->nullable();
                $table->boolean('client_alterar_horario')->nullable();
                $table->boolean('client_desmarcar_horario')->nullable();
                $table->time('inicio')->nullable();
                $table->time('inicio_almoco')->nullable();
                $table->time('fim_almoco')->nullable();
                $table->time('fim')->nullable(); 
            });
//            DB::table('configuracao')->insert(['name_estabelecimento' => 'salao','frequencia_horario' => '20','contato_estabelcimento' => '99999','localizacao' => '11','email_estabelecimento' => 'teste','endereco' => 'teste','client_agendar' => 'teste','client_alterar_horario' => 'teste','client_desmarcar_horario' => 'teste','inicio' => 'teste','inicio_almoco' => 'teste','fim_almoco' => 'teste','fim' => 'teste']);

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
