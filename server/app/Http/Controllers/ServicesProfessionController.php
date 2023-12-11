<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Models\ServicesProfession;

class ServicesProfessionController extends BaseController
{
    public $tratamentos;
    public $profession;
//    public function __construct()
//    {
//        $this->tratamentos = new ServicesProfession();
//        $this->profession = new Profession();
//    }

    protected function getModel()
    {
        return new ServicesProfession();
    }

    public function servicesByIdProfissao(Request $request)
    {
        return $this->tratamentos->getByIdProfession($request->id);
    }
}
