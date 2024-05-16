<?php

use Illuminate\Support\Facades\Route;
//Agregamos UsuariosControlles
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ConductoresController;
use App\Http\Controllers\VehiculosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JornadasController;


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
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
         return view('dashboard');
    })->name('dashboard');
});

//vista para listar los empleados
Route::get('/errors/bd_conexion_error', function () {
   return view('layouts.errors.bd_conexion_error');
});



//rutas para usuarios
Route::post('usuarios/create', [UserController::class, 'create'])->name('usuarios.create')->middleware('auth');
Route::get('usuarios', [UserController::class, 'index'])->name('usuarios')->middleware('auth');
Route::get('usuarios/edit/{id}', [UserController::class, 'edit'])->name('usuarios.edit')->middleware('auth');
Route::post('usuarios/update', [UserController::class, 'update'])->name('usuarios.update')->middleware('auth');
Route::get('usuarios/delete/{id}', [UserController::class, 'delete'])->name('usuarios.delete')->middleware('auth');


Route::resource('/empleados', EmpleadosController::class)->middleware('auth');;




//rutas para conductores
Route::get('conductores/index', [ConductoresController::class, 'index'])->name('index')->middleware('auth');

Route::get('conductores/listarconductores', [ConductoresController::class, 'listarConductores'])->name('listarConductores')->middleware('auth');
Route::get('conductores/delete/{id}', [ConductoresController::class, 'delete'])->name('borrarConductor')->middleware('auth');
Route::get('conductores/candidatos', [ConductoresController::class, 'obtenerCandidatos'])->name('obtenerCandidatos')->middleware('auth');
Route::post('conductores/agregarconductor', [ConductoresController::class, 'agregarConductor'])->name('agregarConductor')->middleware('auth');
Route::post('conductores/updateconductor', [ConductoresController::class, 'updateConductor'])->name('updateConductor')->middleware('auth');

//rutas para vehiculos
Route::get('vehiculos/index', [VehiculosController::class, 'listarVehiculos'])->name('listarVehiculos')->middleware('auth');
Route::post('vehiculos/create', [VehiculosController::class, 'crearVehiculo'])->name('crearVehiculo')->middleware('auth');
Route::get('vehiculos/delete/{id}', [VehiculosController::class, 'borrarVehiculo'])->name('borrarVehiculo')->middleware('auth');
Route::post('vehiculos/updatevehiculo', [VehiculosController::class, 'updateVehiculo'])->name('updateVehiculo')->middleware('auth');

//Rutas para jornadas

Route::get('jornadas/index', [JornadasController::class, 'index'])->name('jornadas.index')->middleware('auth');
Route::get('jornadas/show/{id}', [JornadasController::class, 'show'])->name('jornadas.show')->middleware('auth');

//rutas para los botones de cancelación
Route::get('cancelar/{ruta}', function($ruta){
    return redirect()->route($ruta);
})->name('cancelar')->middleware('auth');