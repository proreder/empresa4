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
        Schema::create('realiza_jornada', function (Blueprint $table) {
            $table->id();
            $table->string('nifnie_conductor',11);
            $table->bigInteger('id_jornada')->unsigned()->nullable();
            $table->dateTime('inicio_jornada'); 
	        $table->dateTime('fin_jornada'); 
	        $table->timestamps();
            $table->foreign('nifnie_conductor')->references('nifnie')->on('empleado')->onDelete('cascade');
            $table->foreign('id_jornada')->references('id')->on('jornada')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realiza_jornada');
    }
};
