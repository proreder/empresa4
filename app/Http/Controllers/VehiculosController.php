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
        return view('layouts.vehiculos.index');
    }

    public function listarVehiculos(){
        $vehiculos= VehiculoModel::all();
        echo "listar vehiculos";
        //dd($vehiculos);
        $html='';
        if($vehiculos->count()>0){
            
             return view('layouts/vehiculos/index',compact('vehiculos'));
        }else{
           echo $html.='<h1 class="text-center text-secundary my-5">No Hay registros en la base de datos</h1>';
        }
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
                $addVehiculo->foto = $request->imagen;
                $addVehiculo->imagen = $rutaImagen;
                $addVehiculo->save();
                return response()->json(['success' => true, 'msg' => 'Datos validados correctamente']);    
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
