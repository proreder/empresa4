<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpleadosModel;

class EmpleadosController extends Controller
{
    
    //listamos todos los registros de la tabla empleados
    public function read(Request $request){
        //obtenemos todos los registros de la tabla Empleado
        $empleados=EmpleadosModel::paginate(3);
        return view('layouts.empleados.index', ['empleados'=> $empleados]);
        
    }
    //Se borra el registro indicado en el parámetro que recibe como argumento
    public function destroy($nifnie){

        EmpleadosModel::destroy($nifnie);
        return redirect('empleados/index');
    }
}
