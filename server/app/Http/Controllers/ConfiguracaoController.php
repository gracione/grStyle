<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Configuracao;
use Illuminate\Support\Facades\App;

class ConfiguracaoController extends BaseController
{

    public $configuracao;
    public function __construct()
    {
        $this->configuracao = new Configuracao();
    }

    protected function getModel()
    {
        return new Configuracao();
    }

    public function alterar(Request $request)
    {
        try {
            $this->configuracao->alterar($request);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function listar()
    {
        return $this->configuracao->getAllConfiguracoes();
    }

}
