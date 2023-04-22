<?php

use Illuminate\Support\Facades\Route;
//Agregamos UsuariosControlles
use App\Http\Controllers\EmpleadosController;


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
Route::get("/empleados/index", "App\Http\Controllers\EmpleadosController@read");

//Ruta para la creación de un nuevo empleado
route::get('/empleados/create', [EmpleadosController::class, 'create']);


Route::get('/conductores/index', function () {
    return view('layouts.conductores.index');
});
