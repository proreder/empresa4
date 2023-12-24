<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmpleadosModel;

class ConductoresModel extends Model
{
    //importamos la tabla Conductor
    protected $table="conductor";
    //no enviamos datos de tiempo
    public $timestamps=true;
    use HasFactory;

    //obtenemos los registros del empleado 
    public function empleado(){
            return $this->hasOne(EmpleadosModel::class, 'nifnie', 'nifnie_empleado');
        
    }

}
