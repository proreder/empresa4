<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
