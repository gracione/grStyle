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

    public function getById($id)
    {
        return $this->model->getById($id);
    }

    public function getByIdFuncionario(Request $request)
    {
        return $this->model->getByIdFuncionario($request);
    }
    public function destroy(Request $request)
    {
        $profissao = $this->model->find($request->id);
        return $profissao->delete($request->id);
    }

}
