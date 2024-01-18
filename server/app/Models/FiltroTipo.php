<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FiltroTipo extends Model
{
    use HasFactory;
    public static function getByIdTratamento($request)
    {
        $id = !empty($request->id) ? $request->id : $request;
        $user = DB::table('filtro_tipo')
            ->join('filtro', 'filtro.id_filtro_tipo', '=', 'filtro_tipo.id')
            ->where('filtro_tipo.id_service_profession', '=', $id)
            ->select(
                'filtro.id as id',
                'filtro.name as name',
                'filtro.porcentagem_tempo as porcentagem_tempo',
                'filtro.id_filtro_tipo as id_filtro_tipo',
                'filtro_tipo.name as name_filtro_tipo',
                'filtro_tipo.id as id_filtro_tipo'
            )
            ->get();
        $ar = $user->toArray();
        $filtro = [];
        $aux = 0;
        $temp = -1;
        foreach ($ar as $key => $value) {
            if ($aux != $value->id_filtro_tipo) {
                $temp += 1;
            }
            $aux = $value->id_filtro_tipo;

            $filtro[$temp][] = $value;
        }

        return $filtro;
    }
}
