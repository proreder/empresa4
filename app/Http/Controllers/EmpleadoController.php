<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado

class EmpleadoController extends Controller
{
    public function read(Request $request){
        $empleados=Empleado::all();
    }
}
