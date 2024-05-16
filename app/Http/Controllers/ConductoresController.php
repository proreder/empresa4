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
        //obtenemos los datos enviados por el formulario de editar usuario y eliminamos el valor del token y method
        $request->except('_token', '_method');
        //dd($request);
        $validator=Validator::make($request->all(),[
           
            'permisos' => 'required',
            'cap' => 'required',
            'tarjeta_tacografo' => 'required',
            'tipo_ADR' => 'required',
            'imagen' => 'nullable|image|mimes:png,jpg|max:5000'
            
        ]);
        //si hay error respondemos con un json y los errores detectados
        if($validator->fails()){
            return response()->json(['msg' => $validator->errors()->toArray()]);
        }else{
            try{
                $rutaImagen=$request->imagen_anterior;
                //obtenemos la ruta de la imagen
                //guardamos las imágenes en store si hay actualización de imagen
                if($request->hasFile('imagen')){
                    
                    $file = $request->file('imagen');
                   
                    $name = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    //guardamos el archivo con su nombre y extension en la carpeta imagenes
                    $rutaImagen= Storage::putFileAs('public/imagenes',$file,$name);
                    
                 }

                
                 //dd($request);
                $editarConductor=ConductoresModel::where('id', $request->id_conductor)->update([
                    'permisos'          => $request->permisos,
                    'cap'               => $request->cap,
                    'tarjeta_tacografo' => $request->tarjeta_tacografo,
                    'tipo_ADR'          => $request->tipo_ADR,
                    'imagen'            => $rutaImagen,
                ]);
                
                // Si no hay errores devolvemos un json con el mensaje
                return response()->json(['success' => true, 'msg' => 'Conductor actualizado correctamente']);
            }catch(\Exception $ex){
                return response()->json(['success' => false, 'msg' => $ex->getMessage()]);   
            } 
        }    
    }

    
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
            'imagen' => 'nullable|image|mimes:png,jpg|max:5000'
            
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
                $addConductor->cap = $request->cap;
                $addConductor->tarjeta_tacografo = $request->tarjeta_tacografo;
                
                $addConductor->tipo_ADR = $request->tipo_ADR;
                $rutaImagen=$request->imagen_candidato_anterior;
                
                //guardamos las imagenes en store
                if ($request->hasFile('imagen')){
                    
                    $file = $request->file('imagen');
                    $name = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    //guardamos el archivo con su nombre y extension en la carpeta imagenes
                    $rutaImagen= Storage::putFileAs('public/imagenes',$file,$name);    
                }
               
                //$addConductor->foto = $request->imagen;
                $addConductor->imagen = $rutaImagen;
                
                $addConductor->save();
                return response()->json(['success' => true, 'msg' => 'Conductor añadido correctamente']);    
            }catch(\Exception $e){
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        }

    }

    
    //obtener el listado de empleados candidatos a conductor
    function obtenerCandidatos(Request $request){
        

        $candidatos = DB::table("empleado")->select('id','nifnie', 'nombre','apellidos', 'imagen')
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
