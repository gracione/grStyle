<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Models\Tratamentos;

class TratamentosController extends BaseController
{
    public $tratamentos;
    public $profession;
    public function __construct()
    {
        $this->tratamentos = new Tratamentos();
        $this->profession = new Profession();
    }

    protected function getModel()
    {
        return new Tratamentos();
    }

    public function listar()
    {
        return $this->tratamentos->listar();
    }

    public function getById($id)
    {
        return [
            'profissoes' => $this->profession->listar(),
            'tratamentos' => $this->tratamentos->getById($id)
        ];
    }

    public function servicesByIdProfissao(Request $request)
    {
        return $this->tratamentos->getByIdProfession($request->id);
    }
    public function inserir(Request $request)
    {
        return $this->tratamentos->inserir($request);
    }
    public function destroy(Request $request)
    {
        return $this->tratamentos->excluir($request);
    }

    public function alterar(Request $request)
    {
        return $this->tratamentos->alterar($request);
    }
}
