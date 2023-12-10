<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Util;
use App\Models\FiltroTipo;

class Tratamentos extends Model
{
    use HasFactory;

    public $tratamento = 'tratamento';
    public $profession = 'profession';
    public $filtroTipo = 'filtro_tipo';
    public $filtro = 'filtro';

    public function listar()
    {
        $select = DB::table($this->tratamento)
            ->select(
                "$this->tratamento.id as id",
                "$this->tratamento.name as servico",
                "$this->profession.name as profession",
                "$this->tratamento.tempo_gasto as tempo_gasto"
            )
            ->join("$this->profession", "$this->profession.id", '=', "$this->tratamento.id_profissao")
            ->get();
        $results = $select->toArray();

        foreach ($results as $key => $value) {
            $results[$key]->tempo_gasto = Util::convertMinutesToHours($value->tempo_gasto);
        }

        return $results;
    }

    public function getByIdProfession($idProfissao)
    {
        $select = DB::table($this->tratamento)
            ->select("$this->tratamento.name as name", "$this->tratamento.id as id")
            ->where("$this->tratamento.id_profissao", '=', $idProfissao)
            ->get();

        return $select->toArray();
    }

    public static function getById($id)
    {
        $select = DB::table('tratamento')
            ->select('tratamento.name as name', 'tratamento.tempo_gasto as tempo_gasto', 'tratamento.id as id', 'tratamento.id_profissao as id_profissao')
            ->where('tratamento.id', '=', $id)
            ->get();

        $result = $select->toArray();

        if (!empty($result[0])) {
            $result[0]->tempo_gasto = Util::convertMinutesToHours($result[0]->tempo_gasto);
            $result[0]->id_profissao = (int)$result[0]->id_profissao;
            $result[0]->filtro = FiltroTipo::getByIdTratamento($id);
        }
        return $result[0];
    }


    public function inserir($request)
    {
        $tratamento['name'] = $request->tratamento;
        $tratamento['tempo_gasto'] = Util::convertHoursToMinutes($request->tempoGasto);
        $tratamento['id_profissao'] = $request->idProfissao;

        $idTratamento = DB::table($this->tratamento)->insertGetId($tratamento);

        return $idTratamento;
    }

    public function excluir($request)
    {
        $filtroTipo = DB::table($this->filtroTipo)
            ->select('*')
            ->where("$this->filtroTipo.id_tratamento", '=', $request->id)
            ->get();

        foreach ($filtroTipo as $value) {
            if (!empty($value->id)) {
                DB::table('filtro')->where('id_filtro_tipo', $value->id)->delete();
            }
        }

        DB::table('filtro_tipo')->where('id_tratamento', $request->id)->delete();
        DB::table($this->tratamento)->where('id', $request->id)->delete();
        return 'deletado';
    }

    public function alterar($request)
    {
        $dadosParaAlterar = [
            'name' => $request->nomeTratamento ?? null,
            'tempo_gasto' => !empty($request->tempoGasto) ? Util::convertHoursToMinutes($request->tempoGasto) : null,
            'id_profissao' => $request->profession ?? null
        ];

        foreach ($request->filtroTipo ?? [] as $key => $value) {
            if (!empty($value['id'])) {
                DB::table('filtro_tipo')
                    ->where('id', $value['id'])
                    ->update(array_filter(['name' => $value['name']]));
            }
        }

        foreach (array_filter($request->filtro) ?? [] as $key => $value) {
            if (!empty($value['id'])) {
                DB::table('filtro')
                    ->where('id', $value['id'])
                    ->update(array_filter($value));
            }
        }

        if (!empty(array_filter($dadosParaAlterar))) {
            DB::table($this->tratamento)
                ->where('id', $request->id)
                ->update(array_filter($dadosParaAlterar));
        }

        return true;
    }
}
