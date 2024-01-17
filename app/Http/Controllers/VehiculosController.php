<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehiculoModel;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
