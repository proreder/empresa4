<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpleadosModel;
//importamos el archivos de validaciones
use App\Http\Requests\StoreEmpleados;

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
    
    //pasamos a la función un objeto de StoreEmpleados que contiene las validaciones
    public function store(StoreEmpleados $request){
        
        //$request->validate([
        //    'nss' => 'required|integer|min:11|max:12|unique:posts'
        //]);
        //obtenemos los enviados por el formulario de empleado nuevo eliminamo el valor del token
        $datosEmpleado=$request->except('_token');
        echo('hola');
        dd($datosEmpleado);
        return response()->json($datosEmpleado);
    }

    //editamos el empleado

    public function edit($id){
        
        $empleado= EmpleadosModel::findOrFail($id);
        //dd($empleado);
        return view('layouts.empleados.edit', compact('empleado'));
    }

    //Se borra el registro indicado en el parámetro que recibe como argumento
    public function destroy($id){

        $empleado= EmpleadosModel::find($id);
        $empleado->delete();
        //EmpleadosModel::destroy($id);
        return redirect('empleados/index');
    }
}
