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
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();
            $table->string('nif_empleado');
            $table->string('premisos');
            $table->boolean('cap');
            $table->boolean('tarjeta_tacografo');
            $table->enum('tipo_ADR',['básico', 'cisternas', 'explosivos', 'radiactivos']);
            $table->timestamps();
            $table->foreign('nif_empleado')->references('nifnie')->on('empleado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conductores');
    }
};
