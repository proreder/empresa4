<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConductoresModel;
use App\Models\empleadosModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
//use JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable;
use DataTables;

class ConductoresController extends Controller
{
    //

    public function index(){
        
        //obtenemos todos los registros de la tabla Empleado
        $conductores=ConductoresModel::paginate(10);
        return view('layouts.conductores.index', compact('conductores'));
       
    }
    //obtenemos un solo registro de la tabla conductores
    
    public function show(Request $request){
         $conductores=ConductoresModel::paginate(10);
        return view('layouts.conductores.index', ['conductores' => $conductores]);
     
    }

    //metodo para guardar los datos en la base de datos
    public function store(Request $request){
       
    }

    //Editamos un conductor
    public function edit($id){

    }
    

    //Editamos un conductor
    public function updateConductor(Request $request){
        
        $validator=Validator::make($request->all(),[
            'permisos' => 'required',
            'cap' => 'required',
            'tarjeta_tacografo' => 'required',
            'tipo_ADR' => 'required',
            'imagen' => 'required|image|mimes:png,jpg|max:5000'
            
        ]);
        //si hay error respondemos con un json y los errores detectados
        if($validator->fails()){
            return response()->json(['msg' => $validator->errors()->toArray()]);
        }else{
            try{
                $editarConductor=ConductoresModel::where('id', $request->id_conductor)->update([
                    'permisos'          => $request->permisos,
                    'cap'               => $request->cap,
                    'tarjeta_tacografo' => $request->tarjeta_tacografo,
                    'tipo_ADR'          => $request->tipo_ADR,
                    'imagen'            => $request->imagen
                ]);
                //procesamos los datos devueltos de los checkbox cap y tarjeta tacografo, si está activado es 'on'
                // y cambiamos a true en caso contrario false para que podamos guardar estos valores en los campos
                //if($request->cap=='on'){
                //    $request->cap=true;
                //}else{
                //    $request->cap=false;
                //}
                // Si no hay errores devolvemos un json con el mensaje
                return response()->json(['success' => true, 'msg' => 'Conductor actualizado correctamente'.$editarConductor]);
            }catch(\Exception $ex){
                return response()->json(['success' => false, 'msg' => $ex->getMessage()]);   
            } 
        }    
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

    //creamos un conductor que obtenemos de la tabla empleados
    public function agregarConductor(Request $request){
        
        $validator=Validator::make($request->all(),[
            'nifnie_candidato' => 'required',
            'permisos' => 'required',
            'cap' => 'required',
            'tarjeta_tacografo' => 'required',
            'tipo_ADR' => 'required',
            'imagen' => 'required|image|mimes:png,jpg|max:5000'
            
        ]);
        //si hay error respondemos con un json y los errores detectados
        if($validator->fails()){
            return response()->json(['msg' => $validator->errors()->toArray()]);
        }else{
            try{
                //añadimo el conductor a la base de datos
                $addConductor = new ConductoresModel;
                $addConductor->nifnie_empleado = $request->nifnie_candidato;
                $addConductor->permisos = $request->permisos;
                if($request->cap==="on") {
                    $addConductor->cap = 1;
                }else{
                    $addConductor->cap = 0;
                }
                if($request->tarjeta_tacografo==="on") {
                    $addConductor->tarjeta_tacografo = 1;
                }else{
                    $addConductor->tarjeta_tacografo = 0;
                }
                
                $addConductor->tipo_ADR = $request->tipo_ADR;
                
                //guardamos las imagenes en store
                $file = $request->file('imagen');
                $name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                //guardamos el archivo con su nombre y extension en la carpeta imagenes
                $rutaImagen= Storage::putFileAs('public/imagenes',$file,$name);
                //$addConductor->foto = $request->imagen;
                $addConductor->imagen = $rutaImagen;
                
                $addConductor->save();
                return response()->json(['success' => true, 'msg' => 'Datos validados correctamente']);    
            }catch(\Exception $e){
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        }

    }
        /*
        $conductores=ConductoresModel::find($nifnie_empleado);
        $conductores->permisos=$request->input('permisos');
        $conductores->cap=$request->input('cap');
        $conductores->tarjeta_tacofrafo=$request->input('tarjeta_tacografo');
        $conductores->tipo_ADR=$request->input('tipo_ADR');
        $conductores->save();
        return redirect()->back();
        */

    
    //obtener el listado de empleados candidatos a conductor
    function obtenerCandidatos(Request $request){
        

        $candidatos = DB::table("empleado")->select('nifnie', 'nombre','apellidos', 'imagen')
                        ->where('tipo','=','Conductor')
                        ->whereNOTIn('nifnie',function($query){
                                                                $query->select('nifnie_empleado')->from('conductor');
                                                            })
                        ->get();
        
               
        return response()->json($candidatos);
        
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
