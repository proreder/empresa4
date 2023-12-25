<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConductoresModel;
class ConductoresController extends Controller
{
    //

    public function index(){
        //obtenemos todos los registros de la tabla Empleado
        //$datos['conductores']=ConductoresModel::all();
        //return view('layouts.conductores.index', $datos);
        $datos=ConductoresModel::paginate(10);
        return view('layouts.conductores.index', compact($datos));
     
    }
    //obtenemos un solo registro de la tabla conductores
    
    public function show(Request $request){
        
        $datos['conductores']=ConductoresModel::paginate(10);
        return view('layouts.conductores.index', $datos);
     
    }

    //metodo para guardar los datos en la base de datos
    public function store(Request $request){
        
    }

    //obtenemos los conductores de la base de datos
    public function listarConductores(Request $request){
        //si hay respuesta ajax correcta la procesamos
        if($request->ajax()){
            return response()->json([
                'code'      => 200,
                'msg'       => 'success',
            ],404);           
        }else{
            //si hay un error devolvemos un json con error 404 y el texto de error
            return response()->json([
                'code'      => 404,
                'msg'       => 'ERROR',
                'message'   => 'Error, no se puede acceder a la página'
            ],404);
        }
    }
    
}
