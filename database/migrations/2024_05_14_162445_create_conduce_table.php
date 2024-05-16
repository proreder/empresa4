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
        Schema::create('conduce', function (Blueprint $table) {
            $table->id();
            $table->string('nifnie_conductor', 11);
            $table->string('matricula_vehiculo', 11);
            $table->unsignedBigInteger('id_jornada');
            $table->dateTime('fecha_asignacion')->nullable();
            $table->datetime('fecha_designacion')->nullable();
            
            $table->foreign('nifnie_conductor')->references('nifnie_empleado')->on('conductor')->onDelete('cascade');
            $table->foreign('id_jornada')->references('id')->on('jornada')->onDelete('cascade');
            $table->foreign('matricula_vehiculo')->references('matricula')->on('vehiculo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conduce');
    }
};
