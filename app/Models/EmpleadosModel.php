<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleadosModel extends Model
{
    
    //importamos la tabla Empleado
    protected $table="empleado";
    //no enviamos datos de tiempo
    public $timestamps=false;
    use HasFactory;

}
