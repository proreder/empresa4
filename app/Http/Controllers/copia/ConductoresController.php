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

    //CREAMOS O AÑADIMOS UN NUEVO Conductor
    public function crearConductor(Request $request){
        $validator=Validator::make($request->all(),[
             'matricula' => 'required',
             'num_chasis' => 'required',
             'potencia' => 'required',
             'tipo' => 'required',
             'modelo' => 'required',
             'km_actuales' => 'required',
             'km_revision' => 'required',
             'disponible' => 'required',
             'imagen' => 'required|image|mimes:png,jpg|max:5000'
             
         ]);
         
 
         //si hay error respondemos con un json y los errores detectados
         if($validator->fails()){
             return response()->json(['msg' => $validator->errors()->toArray()]);
         }else{
             try{
                 //añadimo el vehiculo a la base de datos
                 $addVehiculo = new VehiculoModel;
                 $addVehiculo->matricula = $request->matricula;
                 $addVehiculo->numero_chasis = $request->num_chasis;
                 $addVehiculo->potencia = $request->potencia;
                 $addVehiculo->tipo = $request->tipo;
                 $addVehiculo->modelo = $request->modelo;
                 $addVehiculo->km_actuales = $request->km_actuales;
                 $addVehiculo->km_revision = $request->km_revision;
                 if($request->disponible == "Si"){
                     $addVehiculo->disponible=true;
                 }else{
                     $addVehiculo->disponible=false;
                 }
                 //guardamos las imagenes en store
                 $file = $request->file('imagen');
                 $name = $file->getClientOriginalName();
                 $extension = $file->getClientOriginalExtension();
                 //guardamos el archivo con su nombre y extension en la carpeta imagenes
                 $rutaImagen= Storage::putFileAs('public/imagenes',$file,$name);
                 $addVehiculo->foto = $request->imagen;
                 $addVehiculo->imagen = $rutaImagen;
                 $addVehiculo->save();
                 return response()->json(['success' => true, 'msg' => 'Datos validados correctamente']);    
             }catch(\Exception $e){
                 return response()->json(['success' => false, 'msg' => $e->getMessage()]);
             }
         }
        }
 
     
}
