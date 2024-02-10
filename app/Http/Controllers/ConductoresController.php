<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConductoresModel;

class ConductoresController extends Controller
{
    //

    public function index(){
        $html='';
        echo 'index';
        //obtenemos todos los registros de la tabla Empleado
        //$datos['conductores']=ConductoresModel::all();
        //return view('layouts.conductores.index', $datos);
        $conductores=ConductoresModel::paginate(10);
        return view('layouts.conductores.index', compact('conductores'));
       
    }
    //obtenemos un solo registro de la tabla conductores
    
    public function show(Request $request){

        echo 'show';
        $conductores=ConductoresModel::paginate(10);
        return view('layouts.conductores.index', ['conductores' => $conductores]);
     
    }

    //metodo para guardar los datos en la base de datos
    public function store(Request $request){
        dd($request);
        echo("update: ".$nifnie_empleado);
        $conductores=ConductoresModel::find($nifnie_empleado);
        $conductores->permisos=$request->input('permisos');
        $conductores->cap=$request->input('cap');
        $conductores->tarjeta_tacofrafo=$request->input('tarjeta_tacografo');
        $conductores->tipo_ADR=$request->input('tipo_ADR');
        $conductores->save();
        return redirect()->back();
    }

    //Editamos un conductor
    public function edit($id){

    }
    

    //Editamos un conductor
    public function update($id){
        echo("update id: ".$id);
    }

    /*
    //actualizamos un conductor
    public function update(Request $request, $nifnie_empleado){
        dd($request);
        echo("update: ".$nifnie_empleado);
        $conductores=ConductoresModel::find($nifnie_empleado);
        $conductores->permisos=$request->input('permisos');
        $conductores->cap=$request->input('cap');
        $conductores->tarjeta_tacofrafo=$request->input('tarjeta_tacografo');
        $conductores->tipo_ADR=$reques->input('tipo_ADR');
        $conductores->save();
        return redirect()->back();
    }
*/
    //Borra de la tabla un conductor
    public function delete($id){
        try{
            $conductor_borrado=ConductoresModel::where('id',$id)->delete();
            return response()->json(['success' => true, 'msg' => 'Conductor borrado correctamente.']);
           //return redirect()->back();   
        }catch(\Exception $e){
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
       
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
