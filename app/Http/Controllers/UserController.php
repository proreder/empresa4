<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        
        //obtenemos todos los registros de la tabla Empleado
        $usuarios=User::has('roles')->paginate(20);
        //dd($usuarios);
        return view('layouts.usuarios.index', compact('usuarios'));
       
    }
    //obtenemos un solo registro de la tabla conductores
    
    public function show(Request $request){
         $usuarios=User::paginate(10);
        return view('layouts.usuarios.index', ['usuarios' => $usuarios]);
     
    }

    //CREAMOS O AÑADIMOS UN NUEVO Usuario
    public function crearUsuario(Request $request){
        $validator=Validator::make($request->all(),[
             'nombre_nuevo' => 'required|string|min:6|max:16',
             'email_nuevo' => 'required|email',
             'password_nuevo' => 'required',
             're_password_nuevo' => 'required',
             'rol_nuevo'              => 'required|string'
             
         ]);
         
 
         //si hay error respondemos con un json y los errores detectados
         if($validator->fails()){
             return response()->json(['msg' => $validator->errors()->toArray()]);
         }else{
            //Si la comparación de los password es diferente devolvemos un error en formato json

            if($request->password_nuevo === $request->re_password_nuevo)
             try{
                
 
                 //añadimo el vehiculo a la base de datos
                 $addUsuario = new User;
                 $addUsuario->name = $request->nombre_nuevo;
                 $addUsuario->email = $request->email;
                 $addUsuario->password = $request->password_nuevo;
                 $addUsuario->tipo = $request->tipo;
                 $addUsuario->modelo = $request->modelo;
                 
                 
                 $addUsuario->save();
                 return response()->json(['success' => true, 'msg' => 'Vehículo guardado correctamente']);    
             }catch(\Exception $e){
                 return response()->json(['success' => false, 'msg' => $e->getMessage()]);
             }
         }
 
     }
}
