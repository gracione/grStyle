<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Util;

class Folgas extends Model
{
    use HasFactory;
    protected $table = 'folga';
    public $timestamps = false;
    protected $fillable = ['dia_semana' ,'id_user'];

    public function list($id = false)
    {
        $query = DB::table('folga')
            ->join('user', 'user.id', '=', 'folga.id_user')
            ->join('employee', 'employee.id_user', '=', 'folga.id_user')
            ->join('profession', 'employee.id_profissao', '=', 'profession.id')
            ->join('semana', 'semana.id', '=', 'folga.dia_semana')
            ->select(
                'user.name as employee',
                'semana.name as folga',
                'folga.id as id',
                'folga.dia_semana as dia_semana',
                'profession.name as profession'
            );
    
        if ($id) {
            return $query->where('folga.id', $id)->first();
        }
    
        return $query->get()->toArray();
    }

    public function getByIdFuncionario($request)
    {
        $idFuncionario = $request->dados['idFuncionario'];
        $select = DB::table('folga')
            ->select('dia_semana')
            ->where('id_employee', $idFuncionario)
            ->get();
        $results = $select->toArray();

        $arr = [];
        foreach ($results as $value) {
            $arr[] = $value->dia_semana;
        }
        return $arr;
    }

    public function verificarFolga($request)
    {
        $diaSemana = date('w', strtotime($request->data)) + 1;
        $idFuncionario = $request->idFuncionario;

        $select = DB::table('folga')
            ->select('dia_semana')
            ->where('dia_semana', $diaSemana)
            ->where('id_employee', $idFuncionario)
            ->get();
        $results = $select->toArray();

        return !empty($results[0]) ? true : false;
    }

    public function inserir($request)
    {
        $dados = Util::splitByHashtag($request->dados);

        DB::table('folga')->insert([
            'dia_semana' => $request->diaSemana,
            'id_user' => $dados[1]
        ]);

        return true;
    }

    public function alterar($request)
    {
        $ar['dia_semana'] = $request->diaSemana;

        DB::table('folga')
            ->where('id', $request->id)
            ->update(array_filter($ar));

        return true;
    }
}
