<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolgasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', function(){
    echo 'test';
});
Route::post('/registrarCliente', [App\Http\Controllers\API\AuthController::class, 'registrarCliente']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
    Route::get('/funcionarios/listar', [App\Http\Controllers\FuncionariosController::class, 'listar']);
    Route::post('/funcionarios/listar-id', [App\Http\Controllers\FuncionariosController::class, 'dadosFuncionarioByIdUsuario']);
    Route::get('/funcionarios/listar-funcionarios', [App\Http\Controllers\FuncionariosController::class, 'listarFuncionarios']);
    Route::get('/funcionarios/list-employees-with-user-id', [App\Http\Controllers\FuncionariosController::class, 'listEmployeesWithUserId']);
    Route::post('/funcionarios/inserir', [App\Http\Controllers\FuncionariosController::class, 'inserir']);
    Route::post('/funcionarios/alterar', [App\Http\Controllers\FuncionariosController::class, 'alterar']);
    Route::post('/funcionarios/excluir', [App\Http\Controllers\FuncionariosController::class, 'destroyByIdUsuario']);
    Route::post('/funcionarios/excluir-id', [App\Http\Controllers\FuncionariosController::class, 'destroyByIdFuncionario']);

    Route::post('/servicos-profissao/listar-id-profissao', [App\Http\Controllers\TratamentosController::class, 'getByIdProfissao']);
    Route::post('/servicos-profissao/listar-id', [App\Http\Controllers\TratamentosController::class, 'getById']);
    Route::get('/servicos-profissao/listar', [App\Http\Controllers\TratamentosController::class, 'listar']);
    Route::post('/servicos-profissao/inserir', [App\Http\Controllers\TratamentosController::class, 'inserir']);
    Route::post('/servicos-profissao/alterar', [App\Http\Controllers\TratamentosController::class, 'alterar']);
    Route::post('/servicos-profissao/excluir', [App\Http\Controllers\TratamentosController::class, 'destroy']);

//    Route::post('/tratamentos-funcionarios/listar-id-profissao', [App\Http\Controllers\TratamentosFuncionariosController::class, 'getByIdProfissao']);
//    Route::post('/tratamentos-funcionarios/listar-id', [App\Http\Controllers\TratamentosFuncionariosController::class, 'getById']);
//    Route::get('/tratamentos-funcionarios/listar', [App\Http\Controllers\TratamentosFuncionariosController::class, 'listar']);
//    Route::post('/tratamentos-funcionarios/inserir', [App\Http\Controllers\TratamentosFuncionariosController::class, 'inserir']);
//    Route::post('/tratamentos-funcionarios/alterar', [App\Http\Controllers\TratamentosFuncionariosController::class, 'alterar']);
//    Route::post('/tratamentos-funcionarios/excluir', [App\Http\Controllers\TratamentosFuncionariosController::class, 'destroy']);

    Route::get('/galeria', [App\Http\Controllers\GaleriaController::class, 'listar']);
    Route::post('/galeria/listar-fotos', [App\Http\Controllers\GaleriaController::class, 'fotosAlbum']);
    Route::post('/galeria/upload-foto', [App\Http\Controllers\GaleriaController::class, 'uploadFoto']);
    Route::post('/galeria/inserir', [App\Http\Controllers\GaleriaController::class, 'inserir']);

    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'sair']);
    Route::post('/filtro', [App\Http\Controllers\FiltroController::class, 'listar']);
    Route::get('/filtro', [App\Http\Controllers\FiltroController::class, 'listarFiltro']);
    Route::post('/servicos', [App\Http\Controllers\ServicosController::class, 'listar']);
    Route::post('/filtro-tipo/listar-id', [App\Http\Controllers\FiltroController::class, 'listarFiltroTipoById']);

    Route::post('/horarios-marcados', [App\Http\Controllers\HorarioController::class, 'horariosMarcados']);
    Route::post('/horarios-disponivel', [App\Http\Controllers\HorarioController::class, 'horariosDisponivel']);
    Route::post('/horario/tempo-gasto', [App\Http\Controllers\HorarioController::class, 'tempoGasto']);
    Route::post('/horario/alterar', [App\Http\Controllers\HorarioController::class, 'alterar']);
    Route::post('/horario/inserir', [App\Http\Controllers\HorarioController::class, 'inserir']);
    Route::post('/horario/excluir', [App\Http\Controllers\HorarioController::class, 'desmarcar']);
    Route::post('/horario/confirmar', [App\Http\Controllers\HorarioController::class, 'confirmar']);

    Route::get('/profissao', [App\Http\Controllers\ProfissaoController::class, 'listar']);
    Route::post('/profissao/listar-id', [App\Http\Controllers\ProfissaoController::class, 'getById']);
    Route::post('/profissao/listar-id-funcionario', [App\Http\Controllers\ProfissaoController::class, 'getByIdFuncionario']);
    Route::post('/profissao/inserir', [App\Http\Controllers\ProfissaoController::class, 'inserir']);
    Route::post('/profissao/alterar', [App\Http\Controllers\ProfissaoController::class, 'alterar']);
    Route::post('/profissao/excluir', [App\Http\Controllers\ProfissaoController::class, 'destroy']);

    Route::get('/feriados', [App\Http\Controllers\FeriadoController::class, 'listar']);
    Route::post('/feriados/listar-id', [App\Http\Controllers\FeriadoController::class, 'getById']);
    Route::post('/feriados/listar-mes-ano', [App\Http\Controllers\FeriadoController::class, 'listarByMesAno']);
    Route::post('/feriados/inserir', [App\Http\Controllers\FeriadoController::class, 'inserir']);
    Route::post('/feriados/alterar', [App\Http\Controllers\FeriadoController::class, 'alterar']);
    Route::post('/feriados/excluir', [App\Http\Controllers\FeriadoController::class, 'destroy']);


    Route::get('/folgas/{id}', [FolgasController::class, 'listAction']);
    Route::get('/folgas/', [FolgasController::class, 'listAction']);

//    Route::get('/folgas', [FolgasController::class, 'listAction']);
//    Route::post('/folgas/listar-id', [FolgasController::class, 'getById']);
    Route::post('/folgas/list-holidays-by-employee-id', [FolgasController::class, 'listHolidaysByEmployeeId']);
    Route::post('/folgas/inserir', [FolgasController::class, 'inserir']);
    Route::post('/folgas/alterar', [FolgasController::class, 'alterar']);
    Route::post('/folgas/excluir', [FolgasController::class, 'destroy']);

    Route::get('/ferias', [App\Http\Controllers\FeriasController::class, 'listar']);
    Route::post('/ferias/listar-id', [App\Http\Controllers\FeriasController::class, 'getById']);
    Route::post('/ferias/excluir', [App\Http\Controllers\FeriasController::class, 'destroy']);
    Route::post('/ferias/alterar', [App\Http\Controllers\FeriasController::class, 'alterar']);
    Route::post('/ferias/inserir', [App\Http\Controllers\FeriasController::class, 'inserir']);

    Route::get('/expediente', [App\Http\Controllers\HorarioTrabalhoController::class, 'listar']);
    Route::post('/expediente/listar-id', [App\Http\Controllers\HorarioTrabalhoController::class, 'getById']);
    Route::post('/expediente/listar-id-funcionario', [App\Http\Controllers\HorarioTrabalhoController::class, 'getByIdFuncionario']);
    Route::post('/expediente/inserir', [App\Http\Controllers\HorarioTrabalhoController::class, 'inserir']);
    Route::post('/expediente/alterar', [App\Http\Controllers\HorarioTrabalhoController::class, 'alterar']);
    Route::post('/expediente/excluir', [App\Http\Controllers\HorarioTrabalhoController::class, 'destroy']);

    Route::post('/configuracao/dados-configuracao', [App\Http\Controllers\API\AuthController::class, 'dadosConfiguracao']);
    Route::post('/configuracoes/alterar', [App\Http\Controllers\API\AuthController::class, 'alterar']);
    Route::post('/configuracao-sistema/alterar', [App\Http\Controllers\ConfiguracaoController::class, 'alterar']);
    Route::post('/configuracao-sistema', [App\Http\Controllers\ConfiguracaoController::class, 'listar']);
    Route::post('/configuracoes/enviar-imagem', [App\Http\Controllers\API\AuthController::class, 'enviarImagem'])->name('api.upload.image');

    Route::get('/users', [App\Http\Controllers\API\AuthController::class, 'listar']);

    Route::get('/mensagens', [App\Http\Controllers\MensagemController::class, 'index']);
    Route::post('/mensagens', [App\Http\Controllers\MensagemController::class, 'listar']);
    Route::post('/mensagens', [App\Http\Controllers\MensagemController::class, 'enviar']);
    Route::put('/mensagens/{id}', [App\Http\Controllers\MensagemController::class, 'alterar']);
    Route::delete('/mensagens/{id}', [App\Http\Controllers\MensagemController::class, 'destroy']);

});

Route::post('/verificar-tipo-perfil', [App\Http\Controllers\Controller::class, 'verificarTipoPerfil']);
