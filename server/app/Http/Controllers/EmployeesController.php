<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;

class EmployeesController extends BaseController
{
    protected function getModel()
    {
        return new Employees();
    }

//    public function listar()
//    {
//        return $this->model->listar();
//    }

    public function listarFuncionarios()
    {
        return $this->model->getFuncionariosAndProfissao();
    }
    public function listEmployeesWithUserId()
    {
        return $this->model->listEmployeesWithUserId();
    }


    public function dadosFuncionarioByIdUsuario(Request $request)
    {
        $expediente = new \App\Models\HorarioTrabalho();
        $profession = new \App\Models\Profession();

        $idUsuario = !empty($request->id) ? $request->id : $request;

        $expediente = $expediente->getByIdUsuario($idUsuario);
        $employee = $this->model->getByIdUsuario($idUsuario);
        $profession = $profession->getByIdUsuario($idUsuario);
        $profissoes = $profession->listar();

        return [
            'expediente' => $expediente, 
            'employee' => $employee, 
            'profession' => $profession, 
            'profissoes' => $profissoes
        ];
    }

    public function inserir(Request $request)
    {
        return $this->model->inserir($request);
    }

    public function destroyByIdUsuario(Request $request)
    {
        return $this->model->excluirByIdUsuario($request->id);
    }

    public function destroyByIdFuncionario(Request $request)
    {
        return $this->model->excluirByIdFuncionario($request->id);
    }

    public function alterar(Request $request)
    {
        return $this->model->alterar($request);
    }
}
