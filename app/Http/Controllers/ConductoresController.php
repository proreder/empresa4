<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConductoresModel;
class ConductoresController extends Controller
{
    //

    public function show(Request $request){
        //obtenemos todos los registros de la tabla Empleado
        $conductores=ConductoresModel::paginate(10);
        return view('layouts.conductores.index', ['conductores'=>$conductores]);
     
    }
}
