<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filtro;
use App\Models\FiltroTipo;

class FiltroController extends BaseController
{
    protected function getModel()
    {
        return new Filtro();
    }

    public function listar()
    {
        return $this->model->listar();
    }

    public function listarFiltro(Request $request)
    {
        return $this->model->listarFiltro($request);
    }

    public function listarFiltroTipoById(Request $request)
    {
        $filtroTipo = new FiltroTipo();
        return $filtroTipo->getByIdTratamento($request);
    }
}
