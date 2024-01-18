<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servicos extends Model
{
    use HasFactory;
    public function listar($request)
    {
        $select = DB::table('servico')
            ->select('servico.*')
            ->join('user', 'user.user_type', '=', 'servico.id_tipo_usuario')
            ->where('user.id', $request->dados['idUsuario'])
            ->get();

        return $select;
    }
}
