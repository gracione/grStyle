<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Util;

class HorarioController extends BaseController
{

    protected function getModel()
    {
        return new Horario();
    }

    public function inserir(Request $request)
    {
        // Obtém o horário de início com base na entrada do usuário
        $horarioInicioHora = $request->horario;
    
        // Verifica se o modo tradicional está definido e se o horário é válido
        if (!empty($request->modoTradicional)) {
            if ($this->horario->verificarHorarioModoTradicional($request)) {
                return false;
            }
            $horarioInicioHora = $request->modoTradicional;
        }
    
        // Calcula o tempo gasto em horas e minutos
        $tempoGastoEmHora = Util::calculateTimeSpent($request->idFiltro, $request->idTratamento);
        $tempoGastoEmMinutos = Util::convertHoursToMinutes($tempoGastoEmHora);
    
        // Converte o horário de início para minutos
        $horarioInicioMinutos = Util::convertHoursToMinutes($horarioInicioHora);
    
        // Calcula o horário de término em minutos
        $horarioFimMin = $horarioInicioMinutos + $tempoGastoEmMinutos - 1;
    
        // Converte o horário de término de minutos de volta para horas
        $horarioFimHora = Util::convertMinutesToHours($horarioFimMin);
    
        // Cria um array com os dados a serem inseridos
        $ar = [
            'horario_inicio' => "$request->data $horarioInicioHora:00",
            'horario_fim' => "$request->data $horarioFimHora:00",
            'id_client' => $request->idCliente,
            'id_service_profession' => $request->idTratamento,
            'id_employee' => $request->idFuncionario,
            'confirmed' => empty($request->nameCliente) ? false : true,
            'name_client' => empty($request->nameCliente) ? $request->nameUsuario : $request->nameCliente,
        ];
    
        // Insere os dados no banco de dados utilizando o método apropriado
        return $this->model->inserir($ar);
    }
    
    public function desmarcar(Request $request)
    {
        return $this->model->excluir($request);
    }
    public function destroy(Request $request)
    {
        $horario = $this->model->find($request->id);
        return $horario->delete($request->id);
    }
    public function confirmar(Request $request)
    {
        return $this->model->confirmar($request);
    }

    public function alterar(Request $request)
    {
        return $this->model->alterar($request);
    }

    public function horariosMarcados(Request $request)
    {
        return $this->model->horarioPorDia($request);
    }

    public function tempoGasto(Request $request)
    {
        return $request->filtros == 0 && $request->serviceProfession == 0 ? 0 :
            Util::calculateTimeSpent($request->filtros, $request->serviceProfession);
    }

    public function horariosDisponivel(Request $request)
    {
        return $this->model->listar($request);
    }

    public function verificarHorario($tempo, $horario)
    {
        foreach ($horario as $key => $value) {
            $tempoSeg = Util::convertHoursToSeconds($tempo);
            $inicio = Util::convertHoursToSeconds($value['horario_inicio']);
            $fim = Util::convertHoursToSeconds($value['horario_fim']);
            if ($inicio <= $tempoSeg and $fim >= $tempoSeg) {
                return false;
            }
            return true;
        }
    }
    function converterJsonParaArray($json)
    {
        $vetor = [];
        foreach ($json as $key => $value) {
            $value = get_object_vars($value);
            $vetor[] = $value;
        }
        return $vetor;
    }
}
