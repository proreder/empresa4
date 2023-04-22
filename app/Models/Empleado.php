<?php

namespace App\Models;
use App\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    //importamos la tabla Empleado
    protected $table="empleado";
    //no enviamos datos de tiempo
    public $timestamps=false;
}
