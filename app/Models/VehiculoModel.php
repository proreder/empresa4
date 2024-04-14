<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculoModel extends Model
{
    use HasFactory;
    protected $table="vehiculo";
    protected $fillable=[ 'matricula', 
                        'numero_chasis',
                        'potencia',
                        'tipo',
                        'modelo',
                        'km_actuales',
                        'km_revision',
                        'disponible',
                        'imagen'];

     //no enviamos datos de tiempo
     public $timestamps=false;

}
