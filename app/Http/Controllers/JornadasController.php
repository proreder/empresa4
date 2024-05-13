<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\JornadasModel;
use App\Models\RealizaJornadaModel;
use App\Models\RegistroJornadaModel;
use App\Models\EmpleadosModel;
use Carbon\carbon;

class JornadasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Recuperamos todos los registros de la tabla jornadas
        $jornadas=JornadasModel::paginate(20);
        //$realizajornada=RealizaJornadaModel::all();
        return view('layouts.jornadas.index', compact('jornadas'));

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
    public function show(Request $request, string $id)
    {
        $jornada=JornadasModel::findOrFail($id);
        //$JohnDoe = Students::where('name', '=', 'John Doe')->first();
        $realizaJornada=RealizaJornadaModel::where('id_jornada', '=', $id)->first();
        $nifnie=$realizaJornada->nifnie_conductor;
        $empleados=EmpleadosModel::where('nifnie', '=', $nifnie)->first();
        //return($empleado);
        return view('layouts/jornadas/show', compact('empleados'));
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
