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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id();
            $table->comment('tabla de empleados');
            $table->string('nifnie', 11)->unique();
            $table->string('tipo_doc',10);
            $table->string('nss', 14)->comment('Número de la seguridad social');
            $table->string('sexo', 10);
            $table->date('fecha_nacimiento')->comment('FECHA DE NACIMIENTO DEL EMPLEADOO');
            $table->string('nombre', 50)->comment('nombre empleado');
            $table->string('apellidos', 100)->comment('Apellidos empleado');
            $table->string('tipo_via', 100)->comment('Tipo de la via');
            $table->string('nombre_via', 200)->comment('Nombre de la via');
            $table->integer('numero')->comment('Número de la calle');
            $table->string('planta', 15)->nullable()->comment('Planta');
            $table->string('puerta', 15)->nullable()->comment('Puerta');
            $table->string('municipio', 100)->comment('Municipio de la vivienda');
            $table->string('provincia', 100)->comment('Provincia de la vivienda');
            $table->integer('telefono_fijo')->nullable()->comment('Teléfono fijo');
            $table->integer('telefono_movil')->nullable()->comment('Teléfono móvil');
            $table->integer('cp')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('puesto', 100);
            $table->enum('tipo', ['Oficina', 'Conductor', 'Taller']);
            $table->string('situacion_laboral', 100);
            $table->date('fecha_alta');
            $table->date('fecha_baja')->nullable(); 
            $table->string('comentarios', 300)->nullable();
            $table->string('imagen', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
