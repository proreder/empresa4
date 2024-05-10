<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        
        //obtenemos todos los registros de la tabla usuario
        //$usuarios=User::has('roles')->paginate(20);
        $usuarios=User::paginate(10);
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
             'email'           => 'required|email|unique:users',
             'password'        => 'min:6|max:10|required|confirmed',
             'password_confirmation' => 'min:6|max:10|required',
             'rol_admin'       => 'nullable',
             'rol_usuario'     => 'nullable'
        ]);

        //verificamos que al menos un rol esté seleccionado
        if(!$request->rol_admin && !$request->rol_usuario){
            $validator->errors()->add(
                'rol_admin', 'Un rol debe de estar marcado!'
            );
            //dd($validator->errors()->toArray());
        }
        //si hay error respondemos con un json y los errores detectados
         if($validator->fails()){
             return response()->json(['msg' => $validator->errors()->toArray()]);
         }else{
            

            //Si la comparación de los password es diferente devolvemos un error en formato json
            try{
                
                //añadimos los roles al array
                $roles=[];
                if($request->rol_admin){
                    $roles[0]=$request->rol_admin;
                }
                
                if($request->rol_usuario){
                    $roles[1]=$request->rol_usuario;
                }
                
                 //añadimo el vehiculo a la base de datos
                 $addUsuario = new User;
                 $addUsuario->name = $request->nombre;
                 $addUsuario->email = $request->email;
                 $addUsuario->password = Hash::make($request->password);
                 $addUsuario->email_verified_at=now();
                $addUsuario->save();
                if ($addUsuario->save()) {
                    $addUsuario->id; // Aca obtenés el identificador registrado en la tabla
                    //accedemos al usuario, luego a la relación Roles               
                    $addUsuario->roles()->sync($roles);
                }

                
                

                 return response()->json(['success' => true, 'msg' => 'Usuario guardado correctamente']);    
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
             
             'rol_usuario' => 'nullable',
             'rol_admin' => 'nullable',
             
         ]);
         
 
         //si hay error respondemos con un json y los errores detectados
         if($validator->fails()){
             return response()->json(['msg' => $validator->errors()->toArray()]);
         }else{

            if(!$request->rol_admin && !$request->rol_usuario){
                return response()->json(['msg' => 'Un rol debe de estar marcado']);
            }
             try{
                //guardamos el id de usuario 
                $user->id=$request->id_usuario;
                
                //accedemos al usuario, luego a la relación Roles               
                $user->roles()->sync($request->roles);
                
                 return response()->json(['success' => true, 'msg' => 'Roles actualizados correctamente']);    
             }catch(\Exception $e){
                 return response()->json(['success' => false, 'msg' => $e->getMessage()]);
             }
         }
    
    }

    //Borra de la tabla un usuario por el id
    public function delete($id){
        try{
            
            $user_delete=User::where('id',$id)->delete();
            return response()->json(['success' => true, 'msg' => 'Usuario borrado correctamente.']);
           //return redirect()->back();   
        }catch(\Exception $e){
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
       
    }
     
}
