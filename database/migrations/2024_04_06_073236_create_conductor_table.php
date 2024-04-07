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
        Schema::create('conductor', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string('nifnie_empleado',11);
            $table->enum('permisos', ['C1','C1+E','C','C+E']);
            $table->boolean('cap');
            $table->boolean('tarjeta_tacografo');
            $table->enum('tipo_ADR',['Básico', 'Cisternas', 'Explosivos', 'Radiactivos']);
            $table->string('imagen',250);
            $table->foreign('nifnie_empleado')->references('nifnie')->on('empleado')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conductor');
    }
};
