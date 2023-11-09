<?php
namespace App\Http\Controllers;

use App\Models\Feriado;
use Illuminate\Http\Request;

class FeriadoController extends BaseController
{
    protected function getModel()
    {
        return new Feriado();
    }

    public function listarByMesAno(Request $request)
    {
        return $this->model->listarByMesAno((int) $request['mes'], (int) $request['ano']);
    }
}
