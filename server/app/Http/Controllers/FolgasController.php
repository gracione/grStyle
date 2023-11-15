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

    public function listHolidaysByEmployeeId(Request $request)
    {
        return $this->model->getByIdFuncionario($request);
    }
}
