<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profissao;

class ProfissaoController extends BaseController
{
    public $profissao;

    protected function getModel()
    {
        return new Profissao();
    }

    public function inserir(Request $request)
    {
        return $this->model->inserir($request);
    }

    public function listar()
    {
        return $this->model->listar();
    }

    public function alterar(Request $request)
    {
        return $this->model->alterar($request);
    }

    public function getById(Request $request)
    {
        return $this->profissao->getById($request);
    }
    public function getByIdFuncionario(Request $request)
    {
        return $this->profissao->getByIdFuncionario($request);
    }
    public function destroy(Request $request)
    {
        $profissao = $this->profissao->find($request->id);
        return $profissao->delete($request->id);
    }

}
