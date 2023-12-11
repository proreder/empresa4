<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoductoresModel extends Model
{
    //importamos la tabla Conductor
    protected $table="conductor";
    //no enviamos datos de tiempo
    public $timestamps=true;
    use HasFactory;

}
