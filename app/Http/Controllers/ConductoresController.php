<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConductoresModel;
class ConductoresController extends Controller
{
    //

    public function index(){
        //obtenemos todos los registros de la tabla Empleado
        $datos['conductores']=ConductoresModel::all();
        echo('hola');
        print_r($conductores);
        dd($conductores);
        return view('layouts.conductores.index', $datos);
     
    }
    //obtenemos un solo registro de la tabla conductores
    
    public function show(Request $request){
        
        $datos['conductores']=ConductoresModel::paginate(10);
        return view('layouts.conductores.index', $datos);
     
    }

    
    
}
