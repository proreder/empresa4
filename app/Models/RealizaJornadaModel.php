<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealizaJornadaModel extends Model
{
    use HasFactory;

    protected $table='realiza_jornada';

    public function nombreConductor(){
        return $this->hasOne(EmpleadosModel::class, 'nifnie', 'dninie_conductor');
    }
}
