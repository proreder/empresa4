<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConductoresModel;


class ConductoresController extends Controller
{
    //
    
    public function index(){
        return view('layouts.conductores.index');
    }

    //obtenemos un solo registro de la tabla conductores
    
    public function show(Request $request){
        echo('show'); 
        
        //si hay respuesta ajax correcta la procesamos
        //si hay un error devolvemos un json con error 404 y el texto de error
        /*$conductores =\DB::table('conductor')
        ->select('conductor.*')
        ->orderBy('id','DESC')
        ->get();
        */
        $datos['conductores']=ConductoresModel::paginate(10); 
        dd($datos);  
        //codificamos el array PHP en formato JSON y serializamos el header con texto plano
        return response(json_encode($datos),200)->header('Content-type','text/plain');
      //$datos['conductores']=ConductoresModel::paginate(10);
      // return view('layouts.conductores.index', $datos);
     
    }
    
    //metodo para guardar los datos en la base de datos
   // public function store(Request $request){
        
    //}

    //obtenemos los conductores de la base de datos mediante AJAX
    public function listarConductores(Request $request){
        echo('listarConductores');
        //si hay respuesta ajax correcta la procesamos
        //si hay un error devolvemos un json con error 404 y el texto de error
        /*$conductores =\DB::table('conductor')
        ->select('conductor.*')
        ->orderBy('id','DESC')
        ->get();
        */
        $datos['conductores']=ConductoresModel::all(); 
        
          
        //codificamos el array PHP en formato JSON y serializamos el header con texto plano
        $conductores=\Response::json($datos);
        dd($conductores);
        return view('layouts.conductores.index',compact('conductores'));
    }
}
