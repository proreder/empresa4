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
            $table->id();
            $table->string('nifnie_empleado');
            $table->string('permisos');
            $table->boolean('cap');
            $table->boolean('tarjeta_tacografo');
            $table->enum('tipo_ADR',['básico', 'cisternas', 'explosivos', 'radiactivos']);
            $table->timestamps();
            $table->foreign('nifnie_empleado')->references('nifnie')->on('empleado');
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
