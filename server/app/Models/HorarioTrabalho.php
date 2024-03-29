<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HorarioTrabalho extends Model
{
    use HasFactory;

    protected $table = 'horario_trabalho';
    public $timestamps = false;

    protected $fillable = [
        'inicio1',
        'fim1',
        'inicio2',
        'fim2',
        'id_user',
    ];

    public function employee()
    {
        return $this->belongsTo(Funcionario::class, 'id_employee');
    }

    public function listar()
    {
        $resultado = DB::table('horario_trabalho')
            ->join('user', 'user.id', '=', 'horario_trabalho.id_user')
            ->select(
                'user.name as employee',
                'horario_trabalho.id as id',
                'horario_trabalho.inicio1 as inicio_de_expediente',
                'horario_trabalho.fim1 as inicio_horario_de_almoco',
                'horario_trabalho.inicio2 as fim_horario_de_almoco',
                'horario_trabalho.fim2 as fim_de_expediente'
            )
            ->get();

        return $resultado;
    }

    public function getById($id)
    {
        $result = DB::table('horario_trabalho')
            ->join('user', 'user.id', '=', 'horario_trabalho.id_user')
            ->join('employee', 'employee.id_user', '=', 'user.id')
            ->select(
                'user.name as name',
                'horario_trabalho.id as id',
                'horario_trabalho.inicio1 as inicio_de_expediente',
                'horario_trabalho.fim1 as inicio_horario_de_almoco',
                'horario_trabalho.inicio2 as fim_horario_de_almoco',
                'horario_trabalho.fim2 as fim_de_expediente'
            )
            ->where('user.id', '=', $id)
            ->first();

        return $result ? (array) $result : null;
    }

    public function getByIdUsuario($idUsuario)
    {
        $result = DB::table('horario_trabalho')
            ->join('user', 'user.id', '=', 'horario_trabalho.id_user')
            ->join('employee', 'employee.id_user', '=', 'user.id')
            ->select(
                'user.name as name',
                'horario_trabalho.id as id',
                'horario_trabalho.inicio1 as inicio_de_expediente',
                'horario_trabalho.fim1 as inicio_horario_de_almoco',
                'horario_trabalho.inicio2 as fim_horario_de_almoco',
                'horario_trabalho.fim2 as fim_de_expediente'
            )
            ->where('user.id', '=', $idUsuario)
            ->first();

        return $result ? (array) $result : null;
    }
    public function getByIdFuncionario($id)
    {
        $result = DB::table('horario_trabalho')
            ->join('user', 'user.id', '=', 'horario_trabalho.id_user')
            ->join('employee', 'employee.id_user', '=', 'user.id')
            ->where('employee.id', '=', $id)
            ->select(
                'user.name as name',
                'horario_trabalho.id as id',
                'horario_trabalho.inicio1 as inicio_de_expediente',
                'horario_trabalho.fim1 as inicio_horario_de_almoco',
                'horario_trabalho.inicio2 as fim_horario_de_almoco',
                'horario_trabalho.fim2 as fim_de_expediente'
            )
            ->first();

        return $result;
    }

    public function inserir($request)
    {
        $data = [
            'inicio1' => $request->inicioExpediente . ":00",
            'fim1' => $request->inicioAlmoco . ":00",
            'inicio2' => $request->fimAlmoco . ":00",
            'fim2' => $request->fimExpediente . ":00",
            'id_employee' => $request->idFuncionario
        ];

        $this->fill($data);
        $this->save();

        return true;
    }

}
