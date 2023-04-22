<?php

use Illuminate\Support\Facades\Route;


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




Route::get('/conductores/index', function () {
    return view('layouts.conductores.index');
});
