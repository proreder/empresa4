<?php

namespace App\Models;

//proporciona los métodos para el acceso a base de datos mediante modelos Eloquent
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JornadasModel extends Model
{
    use HasFactory;
    //importamos la tabla Empleado
    
    protected $dateFormat = 'd-m-y';
    protected $table="jornada";
    protected $fillable=[
        'id',
        'inicio_jornada',
        'fin_jornada',
        'fecha_registro'
        ];

    //no enviamos datos de tiempo
    public $timestamps=true;
   
    protected $casts = [
        'inicio_jornada' => 'datetime:d-m-Y',
        'fecha_registro' => 'datetime:d-m-Y',
        
    ];

     //obtenemos los registros de la jornada realizada 
     public function realizaJornada(){
        return $this->hasOne(RealizaJornadaModel::class, 'id_jornada', 'id');
      
      }

      //objenemos los registros de la tabla registro_jornada
      public function rejistroJornada(){
        return $this->hasOne(RejistroJornadaModel::class, 'id_jornada', 'id');
      }

      //obtenemos el 
      //obtenemos el ultimo registro insertado
    public function ultimoRegistro(){
        return $this->hasOne(RegistroJornadaModel::class, 'id_jornada', 'id')->latestOfMany();
    }

    public function nombreConductor(){
        return $this->hasOne(EmpleadosModel::class, 'nifnie_conductor', 'nifnie');
    }
}
