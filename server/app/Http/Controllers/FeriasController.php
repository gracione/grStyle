<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ferias;

class FeriasController extends BaseController
{
    protected function getModel()
    {
        return new Ferias();
    }
}
