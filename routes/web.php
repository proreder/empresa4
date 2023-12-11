<?php

use Illuminate\Support\Facades\Route;
//Agregamos UsuariosControlles
use App\Http\Controllers\EmpleadosController;
use App\http\Controllers\ConductoresController;


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
//Route::get('/empleados/index', function () {
//    return view('layouts.empleados.index');
//});

//vista para listar los empleados
//Route::get("/empleados/index", [EmpleadosController::class, 'read']);

//Ruta para la creación de un nuevo empleado
//route::get('/empleados/create', [EmpleadosController::class, 'create']);

//Obtenemos las rutas de los metodos de conductoresController
Route::resource('/conductores', ConductoresController::class);

//Obtenemos las rutas de los metodos de empleadoController
Route::resource('/empleados', EmpleadosController::class);

/*
Route::get('/conductores/index', function () {
    return view('layouts.conductores.index');
});
*/