<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpleadosModel;

class EmpleadosController extends Controller
{
    
    //listamos todos los registros de la tabla empleados
    public function show(Request $request){
        //obtenemos todos los registros de la tabla Empleado
        $empleados=EmpleadosModel::paginate(10);
        return view('layouts.empleados.index', ['empleados'=> $empleados]);
        
    }

    public function create(){
        return view('layouts.empleados.create');
    }

    public function store(Request $request){
        //obtenemos los enviados por el formulario de empleado nuevo eliminamo el valor del token
        $datosEmpleado=$request->except('_token');
        dd($datosEmpleado);
        return response()->json($datosEmpleado);
    }

    //Se borra el registro indicado en el parámetro que recibe como argumento
    public function destroy($id){

        $empleado= EmpleadosModel::find($id);
        $empleado->delete();
        //EmpleadosModel::destroy($id);
        return redirect('empleados/index');
    }
}
