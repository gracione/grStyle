<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    abstract protected function getModel();

    public function listar()
    {
        return $this->model->all();
    }

    public function getById(Request $request)
    {
        $model = $this->model->find($request->idFeriado);

        return response()->json($model, 200);
    }

    public function inserir(Request $request)
    {
        $this->model->fill(array_filter($request->all()));
        return $this->model->save();
    }

    public function alterar(Request $request)
    {
        $model = $this->model->find($request->id);
        return $model->update(array_filter($request->all()));
    }

    public function destroy(Request $request)
    {
        $model = $this->model->find($request->id);
        return $model->delete($request->id);
    }
}
