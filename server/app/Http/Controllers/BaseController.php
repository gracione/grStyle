<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class BaseController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    abstract protected function getModel();

    public function index()
    {
        $data = $this->model->all();
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $model = $this->model->find($id);

        if (!$model) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        return response()->json($model, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validateStore($request->all());
        $prepared = $this->prepareStore($validated);
        $this->model->fill($prepared);
        $this->model->save();

        return response()->json($this->model, 201);
    }

    protected function validateStore(array $data)
    {
        return $data;
    }

    protected function prepareStore(array $data)
    {
        return array_filter($data);
    }

    public function update(Request $request, $id)
    {
        $model = $this->model->find($id);

        if (!$model) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        $validated = $this->validateUpdate($request->all());
        $prepared = $this->prepareUpdate($validated);
        
        $model->update($prepared);

        return response()->json($model, 200);
    }

    protected function validateUpdate(array $data)
    {
        return $data;
    }

    protected function prepareUpdate(array $data)
    {
        return array_filter($data);
    }

    public function destroy($id)
    {
        $model = $this->model->find($id);

        if (!$model) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        $this->onDelete($model);

        $model->delete();

        return response()->json(['message' => 'Registro deletado com sucesso'], 200);
    }

    protected function onDelete($model)
    {
        // Adicione lógica adicional antes de deletar, se necessário.
    }
}
