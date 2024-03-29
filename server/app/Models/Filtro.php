<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Filtro extends Model
{
    use HasFactory;

    public function listar()
    {
        $user = DB::table('filtro_tipo')
            ->join('funcao_tipo', 'funcao_tipo.id', '=', 'filtro_tipo.id_funcao_tipo')
            ->select('filtro_tipo.id', 'filtro_tipo.name as filtro', 'funcao_tipo.name as funcao')
            ->get();
        return $user;
    }

    public function listarFiltro($request)
    {
        $filtroTipo = DB::table('filtro_tipo')
            ->join('service_profession', 'filtro_tipo.id_service_profession', '=', 'service_profession.id')
            ->join('profession', 'service_profession.id_profissao', '=', 'profession.id')
            ->where('filtro_tipo.id_service_profession', '=', $request->id_service_profession)
            ->select(DB::raw('distinct filtro_tipo.id as id'), 'filtro_tipo.name as name')
            ->get();

        $filtro = [];
        foreach ($filtroTipo as $key => $value) {
            $filtro[$key]['name'] = $value->name;
            $filtro[$key]['id'] = $value->id;
            $filtro[$key]['filtro'] = DB::table('filtro')
                ->where('filtro.id_filtro_tipo', '=', $value->id)
                ->select('*')
                ->get();
        }
        return $filtro;
    }

    public static function filtroById($idFiltro)
    {
        $user = DB::table('filtro')
            ->select(DB::raw('porcentagem_tempo'))
            ->whereIn('id', $idFiltro)
            ->get();
        return $user;
    }
}
