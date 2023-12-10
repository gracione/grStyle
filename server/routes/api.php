<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolgasController;
USE App\Http\Controllers\ProfessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|-
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', [function(){
    echo "test";
    return '';
}]);

Route::post('/registrarCliente', [App\Http\Controllers\API\AuthController::class, 'registrarCliente']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Perfil do usuário
    // Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show']);

    // Profession/Profissão
    Route::get('/profession', [ProfessionController::class, 'index']);
    Route::get('/profession/{id}', [ProfessionController::class, 'show']);
    Route::post('/profession', [ProfessionController::class, 'store']);
    Route::put('/profession/{id}', [ProfessionController::class, 'update']);
    Route::delete('/profession/{id}', [ProfessionController::class, 'destroy']);
    Route::post('/profession/list-id-employee', [ProfessionController::class, 'getByIdEmployee']);
    
    // Services and Professions/Serviços e Profissões
//    Route::get('/services-profession', [App\Http\Controllers\ServicesProfessionController::class, 'index']);
//    Route::get('/services-profession/{id}', [App\Http\Controllers\ServicesProfessionController::class, 'show']);
//    Route::post('/services-profession', [App\Http\Controllers\ServicesProfessionController::class, 'store']);
//    Route::put('/services-profession/{id}', [App\Http\Controllers\ServicesProfessionController::class, 'update']);
//    Route::delete('/services-profession/{id}', [App\Http\Controllers\ServicesProfessionController::class, 'destroy']);
//    Route::get('/services-profession/list-id-profession', [App\Http\Controllers\ServicesProfessionController::class, 'servicesByIdProfession']);
//    
//
//    // Employees/Funcionários
//    Route::get('/employees', [App\Http\Controllers\EmployeesController::class, 'index']);
//    Route::get('/employees/{id}', [App\Http\Controllers\EmployeesController::class, 'show']);
//    Route::post('/employees', [App\Http\Controllers\EmployeesController::class, 'store']);
//    Route::put('/employees/{id}', [App\Http\Controllers\EmployeesController::class, 'update']);
//    Route::delete('/employees/{id}', [App\Http\Controllers\EmployeesController::class, 'destroy']);
//    Route::post('/employees/show-id', [App\Http\Controllers\EmployeesController::class, 'employeeDataByUserId']);
//    Route::get('/employees/list-all-employees', [App\Http\Controllers\EmployeesController::class, 'listAllEmployees']);
//    Route::get('/employees/list-employees-with-user-id', [App\Http\Controllers\EmployeesController::class, 'listEmployeesWithUserId']);
//
//    // Gallery/Galeria
//    Route::get('/gallery', [App\Http\Controllers\GalleryController::class, 'index']);
//    Route::get('/gallery/{id}/photos', [App\Http\Controllers\GalleryController::class, 'albumPhotos']);
//    Route::post('/gallery/upload-photo', [App\Http\Controllers\GalleryController::class, 'uploadPhoto']);
//    Route::post('/gallery', [App\Http\Controllers\GalleryController::class, 'store']);
//
//    // Authentication/Autenticação
//    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
//
//    // Filter/Filtro
//    //Route::post('/filter', [App\Http\Controllers\FilterController::class, 'list']);
//    //Route::get('/filter', [App\Http\Controllers\FilterController::class, 'listFilter']);
//    //Route::post('/filter-type/list-id', [App\Http\Controllers\FilterController::class, 'listFilterTypeById']);
//
//    // Scheduled Hours/ Horários Marcados
//    Route::get('/scheduled-hours', [App\Http\Controllers\ScheduledHoursController::class, 'index']); // List all scheduled hours
//    Route::get('/scheduled-hours/{id}', [App\Http\Controllers\ScheduledHoursController::class, 'show']); // View a specific scheduled hour
//    Route::post('/scheduled-hours', [App\Http\Controllers\ScheduledHoursController::class, 'store']); // Create a new scheduled hour
//    Route::put('/scheduled-hours/{id}', [App\Http\Controllers\ScheduledHoursController::class, 'update']); // Update a specific scheduled hour
//    Route::delete('/scheduled-hours/{id}', [App\Http\Controllers\ScheduledHoursController::class, 'destroy']); // Delete a specific scheduled hour
//    Route::post('/scheduled-hours/available', [App\Http\Controllers\ScheduledHoursController::class, 'availableHours']); // Check available hours
//    Route::post('/scheduled-hours/spent-time', [App\Http\Controllers\ScheduledHoursController::class, 'hoursSpent']); // Calculate spent time
//    Route::post('/scheduled-hours/confirm', [App\Http\Controllers\ScheduledHoursController::class, 'confirm']); // Confirm a scheduled hour
//
//    // Holidays/Feriados
//    Route::get('/holidays', [App\Http\Controllers\HolidayController::class, 'index']);
//    Route::get('/holidays/{id}', [App\Http\Controllers\HolidayController::class, 'getById']);
//    Route::post('/holidays', [App\Http\Controllers\HolidayController::class, 'store']);
//    Route::put('/holidays/{id}', [App\Http\Controllers\HolidayController::class, 'update']);
//    Route::delete('/holidays/{id}', [App\Http\Controllers\HolidayController::class, 'destroy']);
//    Route::post('/holidays/list-month-year', [App\Http\Controllers\HolidayController::class, 'listByMonthYear']);
//
//    // Days Off/Folgas
//    Route::get('/days-off', [DaysOffController::class, 'index']);
//    Route::get('/days-off/{id}', [DaysOffController::class, 'show']);
//    Route::post('/days-off/list-holidays-by-employee-id', [DaysOffController::class, 'listHolidaysByEmployeeId']);
//    Route::post('/days-off', [DaysOffController::class, 'store']);
//    Route::put('/days-off/{id}', [DaysOffController::class, 'update']);
//    Route::delete('/days-off/{id}', [DaysOffController::class, 'destroy']);
//
//    // Vacations/Férias
//    Route::get('/vacations', [App\Http\Controllers\VacationsController::class, 'index']);
//    Route::post('/vacations/{id}', [App\Http\Controllers\VacationsController::class, 'getById']);
//    Route::delete('/vacations', [App\Http\Controllers\VacationsController::class, 'destroy']);
//    Route::put('/vacations', [App\Http\Controllers\VacationsController::class, 'update']);
//    Route::post('/vacations', [App\Http\Controllers\VacationsController::class, 'store']);
//
//    // Work Schedule/Expediente
//    Route::get('/work-schedule', [App\Http\Controllers\WorkScheduleController::class, 'index']);
//    Route::post('/work-schedule/{id}', [App\Http\Controllers\WorkScheduleController::class, 'getById']);
//    Route::post('/work-schedule/list-id-employee', [App\Http\Controllers\WorkScheduleController::class, 'getByIdEmployee']);
//    Route::post('/work-schedule', [App\Http\Controllers\WorkScheduleController::class, 'store']);
//    Route::put('/work-schedule/{id}', [App\Http\Controllers\WorkScheduleController::class, 'update']);
//    Route::delete('/work-schedule/{id}', [App\Http\Controllers\WorkScheduleController::class, 'destroy']);

    // Configuration
//    Route::post('/configuration/configuration-data', [App\Http\Controllers\API\AuthController::class, 'configurationData']);
//    Route::post('/configurations/update', [App\Http\Controllers\API\AuthController::class, 'update']);
//    Route::post('/system-configuration/update', [App\Http\Controllers\ConfigurationController::class, 'update']);
//    Route::get('/system-configuration', [App\Http\Controllers\ConfigurationController::class, 'index']);
//    Route::post('/configurations/upload-image', [App\Http\Controllers\API\AuthController::class, 'uploadImage'])->name('api.upload.image');

    // Users
//    Route::get('/users', [App\Http\Controllers\API\AuthController::class, 'index']);

    //Route::get('/mensagens', [App\Http\Controllers\MensagemController::class, 'index']);
    //Route::post('/mensagens', [App\Http\Controllers\MensagemController::class, 'listar']);
    //Route::post('/mensagens', [App\Http\Controllers\MensagemController::class, 'enviar']);
    //Route::put('/mensagens/{id}', [App\Http\Controllers\MensagemController::class, 'alterar']);
    //Route::delete('/mensagens/{id}', [App\Http\Controllers\MensagemController::class, 'destroy']);

});

Route::post('/verificar-tipo-perfil', [App\Http\Controllers\Controller::class, 'verificarTipoPerfil']);
