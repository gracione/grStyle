<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Util;
use App\Models\FiltroTipo;

class ServicesProfession extends Model
{
    use HasFactory;

    public $servicesProfession = 'services_profession';
    public $profession = 'profession';

    public function listar()
    {
        $select = DB::table($this->servicesProfession)
            ->select(
                "$this->servicesProfession.id as id",
                "$this->servicesProfession.name as servico",
                "$this->profession.name as profession",
                "$this->servicesProfession.tempo_gasto as tempo_gasto"
            )
            ->join("$this->profession", "$this->profession.id", '=', "$this->servicesProfession.id_profissao")
            ->get();
        $results = $select->toArray();

        foreach ($results as $key => $value) {
            $results[$key]->tempo_gasto = Util::convertMinutesToHours($value->tempo_gasto);
        }

        return $results;
    }

    public function getByIdProfession($idProfissao)
    {
        $select = DB::table($this->servicesProfession)
            ->select("$this->servicesProfession.name as name", "$this->servicesProfession.id as id")
            ->where("$this->servicesProfession.id_profissao", '=', $idProfissao)
            ->get();

        return $select->toArray();
    }

    public static function getById($id)
    {
        $select = DB::table('services_profession')
            ->select('services_profession.name as name', 'services_profession.tempo_gasto as tempo_gasto', 'services_profession.id as id', 'services_profession.id_profissao as id_profissao')
            ->where('services_profession.id', '=', $id)
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
        $servicesProfession['name'] = $request->servicesProfession;
        $servicesProfession['tempo_gasto'] = Util::convertHoursToMinutes($request->tempoGasto);
        $servicesProfession['id_profissao'] = $request->idProfissao;

        $idTratamento = DB::table($this->servicesProfession)->insertGetId($servicesProfession);

        return $idTratamento;
    }

}
