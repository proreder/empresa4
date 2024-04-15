<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\VehiculoModel;
use Illuminate\Support\Facades\Validator;

class VehiculosController extends Controller
{
    /**
     * Mostramos una lsta de los camiones disponibles
     */
    public function index()
    {
        $vehiculos=VehiculoModel::paginate(10);
        return view('layouts.vehiculos.index', compact('vehiculos'));
    }

    public function listarVehiculos(){
        $vehiculos= VehiculoModel::all();
        return view('layouts/vehiculos/index',compact('vehiculos'));
       
    }

    
    //CREAMOS O AÑADIMOS UN NUEVO VEHÍCULO
    public function crearVehiculo(Request $request){
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
                $addVehiculo->imagen = $rutaImagen;
                $addVehiculo->save();
                return response()->json(['success' => true, 'msg' => 'Vehículo guardado correctamente']);    
            }catch(\Exception $e){
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        }

    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateVehiculo(Request $request){
        //obtenemos los datos enviados por el formulario de editar usuario y eliminamos el valor del token y method
        $request->except('_token', '_method');
        
        $validator=Validator::make($request->all(),[
             'matricula_edit' => 'required',
             'num_chasis_edit' => 'required',
             'potencia_edit' => 'required',
             'tipo_edit' => 'required',
             'modelo_edit' => 'required',
             'km_actuales_edit' => 'required',
             'km_revision_edit' => 'required',
             'disponible_edit' => 'required',
             'imagen' => 'required|image|mimes:png,jpg|max:5000'
             
         ]);
         
 
         //si hay error respondemos con un json y los errores detectados
         if($validator->fails()){
             return response()->json(['msg' => $validator->errors()->toArray()]);
         }else{
             try{
                $disponible=true;
                 //añadimo el vehiculo a la base de datos
                 
                 if($request->disponible == "Si"){
                     $disponible=true;
                 }else{
                     $disponible=false;
                 }
                 //guardamos las imagenes en store
                 //$file = $request->file('imagen');
                 //$name = $file->getClientOriginalName();
                 //$extension = $file->getClientOriginalExtension();
                 //guardamos el archivo con su nombre y extension en la carpeta imagenes
                 //$rutaImagen= Storage::putFileAs('public/imagenes',$file,$name);
                 //$addVehiculo->imagen = $rutaImagen;
                 $addVehiculo=VehiculoModel::where('id', $request->id_vehiculo)->update([
                    'matricula'   => $request->matricula,
                    'num_chasis'  => $request->num_chasis,
                    'potencia'    => $request->potencia,
                    'tipo'        => $request->tipo,
                    'modelo'      => $request->modelo,
                    'km_actuales' => $request->km_actuales,
                    'km_revision' => $request->km_revision,
                    'disponible'  =>  $disponible,
                    'imagen'      => $request->imagen

                   
                ]);
                 return response()->json(['success' => true, 'msg' => 'Vehículo guardado correctamente']);    
             }catch(\Exception $e){
                 return response()->json(['success' => false, 'msg' => $e->getMessage()]);
             }
         }
    
        }
    
        //Borra de la tabla un vehículo por el id
    public function borrarVehiculo($id){
        try{
            
            $conductor_borrado=VehiculoModel::where('id',$id)->delete();
            return response()->json(['success' => true, 'msg' => 'Vehículo borrado correctamente.']);
           //return redirect()->back();   
        }catch(\Exception $e){
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
       
    }
    
}
