<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registro_jornada', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jornada');
	        $table->unsignedTinyInteger('numero_linea');
	        $table->enum('estado' , ['Inicio','Final','Conducción','Descanso','Otros trabajos','Disponibilidad']); 
	        $table->time('tiempo_estado'); 
	        $table->string('latitud', 12);
	        $table->string('longitud', 12);
	        $table->string('nifnie_conductor', 11);
	        $table->timestamps();

            $table->foreign('nifnie_conductor')->references('nifnie_empleado')->on('conductor')->onDelete('cascade');
            $table->foreign('id_jornada')->references('id')->on('jornada')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_jornada');
    }
};
