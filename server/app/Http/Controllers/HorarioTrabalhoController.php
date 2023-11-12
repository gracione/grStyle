<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente as HorarioTrabalho;

class HorarioTrabalhoController extends BaseController
{
    protected function getModel()
    {
        return new HorarioTrabalho();
    }

    public function listar()
    {
        return $this->model->listar();
    }
    public function getById(Request $request)
    {
        return $this->model->getByIdUsuario($request->id);
    }

    public function inserir(Request $request)
    {
        return $this->model->inserir($request);
    }
    public function destroy(Request $request)
    {
        $expediente = $this->model->find($request->id);
        return $expediente->delete($request->id);
    }

}
