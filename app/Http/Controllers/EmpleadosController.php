<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use App\Models\EmpleadosModel;
use Illuminate\Support\Facades\Storage;
//importamos el archivos de validaciones esterno
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
    
        //obtenemos los enviados por el formulario de empleado nuevo eliminamos el valor del token
        $datosEmpleado=$request->except('_token');
       
        //guardamos la ruta de la imagen en y la imagen en la carpeta storage
        //guardamos las imagenes en store
        $file = $request->file('imagen');
        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        //guardamos el archivo con su nombre y extension en la carpeta imagenes
        $rutaImagen= Storage::putFileAs('public/imagenes',$file,$name);
        if($request->hasFile('imagen')){
            $datosEmpleado['imagen']=$rutaImagen;
        }
        try{
            EmpleadosModel::insert($datosEmpleado);
            return redirect('empleados/index')->with('success', 'success');
        }catch(\Exception $e){
            return redirect('empleados/index')->with('success', 'error');
        }
        
        //return response()->json($datosEmpleado);
    }

    //editamos el empleado

    public function edit($id){
        
        $empleado= EmpleadosModel::findOrFail($id);
        
       //dd($empleado);
        return view('layouts.empleados.edit', compact('empleado'));
    }

    public function update(Request $request, $id){
       //obtenemos los datos enviados por el formulario de editar usuario y eliminamos el valor del token y method
        $datosEmpleado=$request->except('_token', '_method');
        
        if($request->hasFile('imagen')){
            //guardamos la ruta de la imagen en y la imagen en la carpeta storage
            //guardamos las imagenes en store
            $file = $request->file('imagen');
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            //guardamos el archivo con su nombre y extension en la carpeta imagenes
            $rutaImagen= Storage::putFileAs('public/imagenes',$file,$name);
            $datosEmpleado['imagen']=$rutaImagen;
        }
        
        try{
            
            EmpleadosModel::where('id', '=', $id)->update($datosEmpleado);
            return redirect('empleados/index')->with('actualizado', 'El empleado se ha actulaizado con éxito');
        }catch(\Exception $e){
            return redirect('empleados/edit')->with('actualizado', 'Error en la actualización');
            dd ($e);
        }
        
    }

    //Se borra el registro indicado en el parámetro que recibe como argumento
    public function destroy($id){
        try{
            $empleado= EmpleadosModel::find($id);
             $empleado->delete();
            //EmpleadosModel::destroy($id);
            //si se ha borrado el empleado retirnamos success
            return redirect('empleados/index')->with('borrado', 'El el emplado se ha borrado con éxito');
        }catch(\Exception $e){
            return redirect('empleados/edit')->with('borrado', 'Ocurrió un error durante el borrado');
            
        }
        
    }
}
