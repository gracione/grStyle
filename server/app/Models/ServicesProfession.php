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

    public $serviceProfession = 'service_profession';
    public $profession = 'profession';
    protected $table = 'service_profession';
    protected $fillable = ['name','time_spent','id_profession'];

    public function listar()
    {
        $select = DB::table($this->serviceProfession)
            ->select(
                "$this->serviceProfession.id as id",
                "$this->serviceProfession.name as servico",
                "$this->profession.name as profession",
                "$this->serviceProfession.tempo_gasto as tempo_gasto"
            )
            ->join("$this->profession", "$this->profession.id", '=', "$this->serviceProfession.id_profissao")
            ->get();
        $results = $select->toArray();

        foreach ($results as $key => $value) {
            $results[$key]->tempo_gasto = Util::convertMinutesToHours($value->tempo_gasto);
        }

        return $results;
    }

    public function getByIdProfession($idProfissao)
    {
        $select = DB::table($this->serviceProfession)
            ->select("$this->serviceProfession.name as name", "$this->serviceProfession.id as id")
            ->where("$this->serviceProfession.id_profissao", '=', $idProfissao)
            ->get();

        return $select->toArray();
    }

    public static function getById($id)
    {
        $select = DB::table('service_profession')
            ->select('service_profession.name as name', 'service_profession.tempo_gasto as tempo_gasto', 'service_profession.id as id', 'service_profession.id_profissao as id_profissao')
            ->where('service_profession.id', '=', $id)
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
        $serviceProfession['name'] = $request->serviceProfession;
        $serviceProfession['tempo_gasto'] = Util::convertHoursToMinutes($request->tempoGasto);
        $serviceProfession['id_profissao'] = $request->idProfissao;

        $idTratamento = DB::table($this->serviceProfession)->insertGetId($serviceProfession);

        return $idTratamento;
    }

}
