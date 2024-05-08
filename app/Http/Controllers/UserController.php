<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

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
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
             'nombre'          => 'required|string|min:6|max:25',
             'email'           => 'required|email',
             'password'        => 'min:6|max:10|required|confirmed',
             'password_confirmation' => 'min:6|max:10|required',
             'rol_admin'       => 'nullable|string',
             'rol_usuario'     => 'nullable|string'
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
                 
                 
                 
                 $addUsuario->save();
                 return response()->json(['success' => true, 'msg' => 'Vehículo guardado correctamente']);    
             }catch(\Exception $e){
                 return response()->json(['success' => false, 'msg' => $e->getMessage()]);
             }
         }
 
     }


     //editamos el usuario y obtenemos el id mediante una instancia de  User, mostramos todos los permisos


     public function edit($id){
        //recuperamos el usuario
        $usuario=User::findOrFail($id);
        
        //recuperamos todos los roles
        $roles=Role::all();
        //return $roles;
        //devolvemos  la vista usuarios.index el ususario y los roles
        return view('layouts.usuarios.edit' , compact('usuario', 'roles'));
     }


     //se actualiza registro de usuario con los roles
     public function update(Request $request, User $user){
        
        //obtenemos los datos enviados por el formulario de editar usuario y eliminamos el valor del token y method
        $request->except('_token', '_method');
        
        $validator=Validator::make($request->all(),[
            
             'rol_usuario' => 'required',
             'rol_admin' => 'required',
             
             
         ]);
         
 
         //si hay error respondemos con un json y los errores detectados
         if($validator->fails()){
             return response()->json(['msg' => $validator->errors()->toArray()]);
         }else{

            if(!$request->rol_admin && !$request->rol_usuario){
                return response()->json(['msg' => 'Un rol debe de estar marcado']);
            }
             try{
                $user->id=$request->user;
                
                //accedemos al usuario, luego a la relación Roles               
                $user->roles()->sync($request->roles);
                 return response()->json(['success' => true, 'msg' => 'Roles actualizados correctamente']);    
             }catch(\Exception $e){
                 return response()->json(['success' => false, 'msg' => $e->getMessage()]);
             }
         }
    
    }
     
}
