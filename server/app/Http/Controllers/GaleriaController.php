<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Galeria;
use App\Models\Image;
use Illuminate\Support\Facades\App;

class GaleriaController extends BaseController
{
    protected function getModel()
    {
        return new Galeria();
    }

    public function listar()
    {
        return $this->model->listar();
    }

    public function fotosAlbum(Request $request)
    {
        return $this->model->fotosAlbum($request);
    }
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $publicPath = public_path('/perfil');
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move($publicPath, $imageName);

//        $idUsuario = auth()->user()->id;
        $image = new Image();
        $publicPath = public_path('perfil/' . $imageName);

        if (file_exists($publicPath)) {
            $imageContent = file_get_contents($publicPath);
            $imageData = base64_encode($imageContent);
            $imageSrc = 'data:image/' . pathinfo($publicPath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
        }
        $image->album_id = $request->idAlbum;
        $image->name_arquivo = $imageSrc;
        $image->description = 'teste';
        $image->save();
        return $imageSrc;
    }
    public function inserir(Request $request)
    {
        return $this->model->inserir($request);
    }

    public function destroy(Request $request)
    {
        $galeria = $this->model->find($request->id);
        return $galeria->delete($request->id);
    }

    public function alterar(Request $request)
    {
        try {
            $this->model->alterar($request);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
