<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\JornadasModel;
use App\Models\RealizaJornadaModel;
use App\Models\RegistroJornadaModel;
use App\Models\VehiculoModel;
use App\Models\ConduceModel;
use App\Models\EmpleadosModel;
use Carbon\carbon;
use DateTime;

class JornadasController extends Controller
{
    private $array_jornada=[];
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
        //obtenemos el registro por el id de la tabla realiza jornada,
        $realiza_jornada=RealizaJornadaModel::where('id_jornada', '=', $id)->first();

        //obtenemos el nifnie del conductor
        $nifnie=$realiza_jornada->nifnie_conductor;

        //calculo de las fechas y horas de las jornadas
        $hora_inicio=$realiza_jornada->inicio_jornada;
        
        //array que contedrá los calculos de los tiempos
        //$array_jornada=[];
        $date_time_inicio=new DateTime($hora_inicio);
        $dia_inicio=$date_time_inicio->format('d-m-Y');
        $this->array_jornada['dia']=$dia_inicio;

        //Hora inicio
        $hora_inicio=$date_time_inicio->format('H:i');
        $this->array_jornada['inicio']=$hora_inicio;

        //Hora fin
        $hora_final=$realiza_jornada->fin_jornada;
        $date_time_fin=new DateTime($hora_final);
        $hora_fin=$date_time_fin->format('H:i');
        $this->array_jornada['fin']=$hora_fin;
        
        //tiempo totaL
        $total_tiempo=$date_time_inicio->diff($date_time_fin);
        $total=$total_tiempo->format('%H:%i');
        $this->array_jornada['tiempos']['total']=$total;
        $result=[];

        //where and eloquet, buscamos realizando un and en la tabla RealizaJornada

        $where_and_id_nif= ['id_jornada' => $id, 'nifnie_conductor' => $nifnie];
        
        //obtenemos el vehiculo conducido por el id_jornada en la tabla conduce
        $conduce=ConduceModel::where($where_and_id_nif)->first();
        $this->array_jornada['vehiculo']['matricula']=$conduce->matricula_vehiculo;
        //return $array_jornada;
        //obtenemos datos del vehiculo
        $vehiculo=VehiculoModel::where('matricula', '=', $conduce->matricula_vehiculo)->first();
        
        $this->array_jornada['vehiculo']['modelo']=$vehiculo->modelo;
        $this->array_jornada['vehiculo']['imagen']=$vehiculo->imagen;
       // return $array_jornada;
        //calculos de tiempos
        //Obtenemos los tiempos de trabajo
        //where and eloquet, buscamos realizando un and en la tabla RealizaJornada
        $estados=[];
        $where_id_jornada= ['id_jornada' => $id];
        $jornada_conduccion=RegistroJornadaModel::where($where_id_jornada)->get();
        $jornadas=(array) json_decode($jornada_conduccion);
        //return $jornadas;

        //obtenemos los tiempos
        $this->separaDatosTiempo($jornadas);

        //obtenemos los datos gps
        $this->separaDatosGps($jornadas);
        //return $this->array_jornada;
        //array_push($array_jornada,  $this->datos_tiempos);

        $array_jornada=$this->array_jornada;
        $empleados=EmpleadosModel::where('nifnie', '=', $nifnie)->first();
        //return($empleado);
        return view('layouts/jornadas/show', compact('empleados', 'array_jornada'));
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
    function separaDatosTiempo($jornadas){
        $conduccion=0;
        $otros_trabajos=0;
        $disponibilidad=0;
        $descanso=0;
        $array_estados=[];
        $estado="";
        $tiempo="";
        $estado_anterior="";
        $array=[];
        foreach ($jornadas as $jornada){
            foreach($jornada as $key => $valor){
            
                if($valor==="Conducción") $conduccion+=1;
                elseif($valor==="Otros trabajos") $otros_trabajos+=1;
                elseif($valor==="Disponibilidad") $disponibilidad+=1;
                elseif($valor==="Descanso") $descanso+=1;
            }

               
        }

        $total_conduccion=date('H:i', mktime(0, $conduccion*5)); 
        $total_otros_trabajos=date('H:i', mktime(0, $otros_trabajos*5));
        $total_disponibilidad=date('H:i', mktime(0, $disponibilidad*5));
        $total_descanso=date('H:i', mktime(0, $descanso*5));
        $this->array_jornada['tiempos']['Conduccion']= $total_conduccion;
        $this->array_jornada['tiempos']['Otros trabajos']=$total_otros_trabajos;
        $this->array_jornada['tiempos']['Disponibilidad'] = $total_disponibilidad;
        $this->array_jornada['tiempos']['Descanso'] = $total_descanso;
        
        //array_push($this->datos_tiempos, $array);
        //return $this->datos_tiempos=$array;
        //recorremos el array para obtener los tiempos los saltos de tiempos son de 5 min.
    
    }

    function separaDatosGps($jornadas){
        //return $jornadas;
        $latitud=0;
        $longitud=0;
        foreach ($jornadas as $jornada){
            foreach($jornada as $key => $valor){
                
                if($key==="latitud" && !$valor==0) {
                    $latitud=$valor;
                    
                }
                if($key==="longitud" && !$valor==0) {
                    $longitud=$valor;
                   
                }
                
            }
            
            $this->array_jornada['gps'][]=['lat' => $latitud, 'lon' => $longitud];

               
        }
    }

    private function sumarTiempo($tiempos){
        $tiempo_parcial=[];
        foreach ($tiempos as $tiempo) {
            // Segundos
            $tiempo_parcial['segundos'] = floatval($tiempo_parcial['segundos']) + floatval($tiempo['segundos']);
            $minutos = intval($tiempo_parcial['segundos'] / 60);
            $tiempo_parcial['segundos'] -= $minutos * 60;
            // Minutos
            $tiempo_parcial['minutos'] = intval($tiempo_parcial['minutos']) + intval($tiempos['minutos'] + $minutos);
            $horas = intval($tiempo_parcial['minutos'] / 60);
            $tiempo_parcial['minutos'] -= $horas * 60;
            // Horas
            $tiempo_parcial['horas']
                = intval($tiempo_parcial['horas'])
                + intval($tiempo['horas'] + $horas);
           
        }
        return $tiempo_parcial;    
    }
    
    /**
     * Formatea y devuelve el tiempo final
     *
     * @return String Tiempo final formateado
     */
    public function verTiempoFinal($tiempo)
    {
        return sprintf(
            '%02s:%02s:%05s',
            $tiempo['horas'],
            $tiempo['minutos'],
            $tiempo['segundos']
        );
    }

   
}
