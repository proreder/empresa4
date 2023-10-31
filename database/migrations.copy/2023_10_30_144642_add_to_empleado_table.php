<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * migración para añadir registros y claves foraneas a la tabla empleado
     */
    public function up(): void
    {
        Schema::table('empleado', function (Blueprint $table) {
            //
            $table->after('nifnie', function($table){
                $table->string('tipo_doc');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleado', function (Blueprint $table) {
            //
            $table->dropColumn('tipo_doc');
        });
    }
};
