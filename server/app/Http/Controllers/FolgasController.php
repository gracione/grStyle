<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folgas;

class FolgasController extends BaseController
{
    protected function getModel()
    {
        return new Folgas();
    }

    public function listAction($id = false) {
        return $this->model->list($id);
    }

    public function listHolidaysByEmployeeId(Request $request)
    {
        return $this->model->getByIdFuncionario($request);
    }
}
