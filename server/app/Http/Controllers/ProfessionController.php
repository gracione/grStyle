<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profession;

class ProfessionController extends BaseController
{
    public $profession;

    protected function getModel()
    {
        return new Profession();
    }

//    public function inserir(Request $request)
//    {
//        return $this->model->inserir($request);
//    }

    public function listAction($id = false)
    {
        return $this->model->list($id);
        
    }
    public function alterar(Request $request)
    {
        return $this->model->alterar($request);
    }

    // public function getById($id)
    // {
    //     return $this->model->getById($id);
    // }

    public function getByIdFuncionario(Request $request)
    {
        return $this->model->getByIdFuncionario($request);
    }
    //public function destroy(Request $request)
    //{
    //    $profession = $this->model->find($request->id);
    //    return $profession->delete($request->id);
    //}

}
