<?php

use Illuminate\Support\Facades\Route;
//Agregamos UsuariosControlles
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ConductoresController;
use App\Http\Controllers\VehiculosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('auth.login');
});
*/
Route::get('/', function () {
    return view('auth.login');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//vista para listar los empleados
Route::get('/errors/bd_conexion_error', function () {
   return view('layouts.errors.bd_conexion_error');
});

//vista para listar los empleados
//Route::get("/empleados/index", [EmpleadosController::class, 'read']);

//Ruta para la creación de un nuevo empleado
//route::get('/empleados/create', [EmpleadosController::class, 'create']);

//Obtenemos las rutas de los metodos de conductoresController
//Route::resource('/conductores', ConductoresController::class);

//Obtenemos las rutas de los metodos de empleadoController
//Route::resource('/empleados', EmpleadosController::class);
//Route::group(['prefix' =>'admin', 'as' => 'admin'], function(){
 //   Route::post('/conductores/listar','ConductoresController@listarConductores');

    
  /*  Route::resources([
        '/empleados'   =>EmpleadosController::class,
        '/conductores' => ConductoresController::class]);
        */
//});
Route::resources([
    '/empleados'   =>EmpleadosController::class
    ]
);

//rutas para conductores
Route::get('conductores/index', [ConductoresController::class, 'index'])->name('index');

Route::get('conductores/listarconductores', [ConductoresController::class, 'listarConductores'])->name('listarConductores');
Route::get('conductores/delete/{id}', [ConductoresController::class, 'delete'])->name('borrarConductor');
Route::get('conductores/candidatos', [ConductoresController::class, 'obtenerCandidatos'])->name('obtenerCandidatos');

//rutas para vehiculos
Route::get('vehiculos/index', [VehiculosController::class, 'listarVehiculos'])->name('listarVehiculos');
Route::post('vehiculos/create', [VehiculosController::class, 'crearVehiculo'])->name('crearVehiculo');

/*
Route::controller(ConductoresController::class)->group(function(){
    Route::get('/conductores/index','index')->name('index');
    Route::get('/conductores/lista','listarConductores')->name('conductores.lista');
    //Route::match(['get', 'post'], '/conductores/lista', 'listarConductores')->name('conductores.lista');
    Route::post('conductores/editar','edit')->name('editar');
});

*/
