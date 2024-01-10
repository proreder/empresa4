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
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id();
            $table->string('matricula', 11)->unique();
            $table->string('numero_chasis',40)->unique();
            $table->integer('potencia');
            $table->string('tipo',100);
            $table->string('modelo',100);
            $table->integer('km_actuales');
            $table->integer('km_revision');
            $table->boolean('disponible');
            $table->binary('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
