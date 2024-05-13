<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroJornadaModel extends Model
{
    use HasFactory;
    protected $table="registro_jornada";


    //obtenemos el ultimo registro insertado
    public function ultimoRegistro(){
        return $this->hasOne(RegistroJornada::class)->latestOfMany();
    }
}
