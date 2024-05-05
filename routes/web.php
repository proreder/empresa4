<?php

use Illuminate\Support\Facades\Route;
//Agregamos UsuariosControlles
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ConductoresController;
use App\Http\Controllers\VehiculosController;
use App\Http\Controllers\UserController;


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
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
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

//Route::get('empleados/update/{id}', [EmpleadosController::class, 'update'])->name('empleado.update');
//Route::resource('/usuarios', UserController::class)->middleware('auth');
//Route::get('usuarios', [UserController::class, 'index'])->middleware('can:admin-users')->name('usuarios');
Route::post('usuarios/create', [UserController::class, 'crearUsuario'])->name('crearUsuario');
Route::get('usuarios', [UserController::class, 'index'])->name('usuarios');
Route::get('usuarios/edit/{id}', [UserController::class, 'edit'])->name('usuarios.edit');
/*
Route::get('empleados/create', [EmpleadosController::class, 'create'])->name('empleados.create');
Route::get('empleados/{id}/edit/', [EmpleadosController::class, 'edit'])->name('edit');
*/
//Route::put('empleados/{id}', [EmpleadosController::class, 'update'])->name('empleado.update');
Route::resource('/empleados', EmpleadosController::class);

/*
Route::get('empleados/index', [empleadosController::class, 'show'])->name('index');
Route::get('empleados/create', [empleadosController::class, 'create'])->name('create');
Route::get('empleados/edit/{id}', [empleadosController::class, 'edit'])->name('edit');
*/


//rutas para conductores
Route::get('conductores/index', [ConductoresController::class, 'index'])->name('index');

Route::get('conductores/listarconductores', [ConductoresController::class, 'listarConductores'])->name('listarConductores');
Route::get('conductores/delete/{id}', [ConductoresController::class, 'delete'])->name('borrarConductor');
Route::get('conductores/candidatos', [ConductoresController::class, 'obtenerCandidatos'])->name('obtenerCandidatos');
Route::post('conductores/agregarconductor', [ConductoresController::class, 'agregarConductor'])->name('agregarConductor');
Route::post('conductores/updateconductor', [ConductoresController::class, 'updateConductor'])->name('updateConductor');

//rutas para vehiculos
Route::get('vehiculos/index', [VehiculosController::class, 'listarVehiculos'])->name('listarVehiculos');
Route::post('vehiculos/create', [VehiculosController::class, 'crearVehiculo'])->name('crearVehiculo');
Route::get('vehiculos/delete/{id}', [VehiculosController::class, 'borrarVehiculo'])->name('borrarVehiculo');
Route::post('vehiculos/updatevehiculo', [VehiculosController::class, 'updateVehiculo'])->name('updateVehiculo');


