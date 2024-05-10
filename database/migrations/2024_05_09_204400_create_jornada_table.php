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
        Schema::create('jornada', function (Blueprint $table) {
            $table->id();
            $table->dateTime('inicio_jornada')->nullable();
            $table->dateTime('fin_jornada')->nullable(); 
            $table->dateTime('fecha_registro')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jornada');
    }
};
