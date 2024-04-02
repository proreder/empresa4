<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConductoresModel extends Model
{
    
    use HasFactory;
    protected $table="conductor";
    protected $fillable=[
     'id',
     'nifnie_empleado',
     'permisos',
     'cap',
     'tarjeta_tacofrafo',
     'tipo_ADR',
     'imagen'
     ];
     
    //no enviamos datos de tiempo
     public $timestamps=true;
     
    //obtenemos los registros del empleado 
    public function empleado(){
      return $this->hasOne(EmpleadosModel::class, 'nifnie', 'nifnie_empleado');
    
    }
}
