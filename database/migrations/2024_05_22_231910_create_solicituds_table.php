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
        Schema::create('solicituds', function (Blueprint $table) {
            $table->foreignId('perfil_id');
            $table->id();
            $table->timestamps();
            $table->string('N_solicitud');
            $table->string('cedula_solicitante');
            $table->string('nombre_evento');
            $table->string('publicidad');
            $table->text('descripcion');
            $table->date('fecha_inspeccion');
            $table->date('fecha_solicitud');
            $table->string('permiso_provisional');
            $table->string('permiso_definitivo');
            $table->date('fecha_evento');
            $table->date('fecha_permisoprovisional')->nullable();
            $table->date('fecha_permisodefinitivo')->nullable();
            $table->string('id_inspector');
            $table->string('cedula_aapp');
            $table->string('cedula_dat');
            $table->string('url_rif');
            $table->string('url_permiso');
            $table->integer('numero_entradas');
            $table->integer('numero_funciones');
            $table->enum('estado', ['pendiente', 'provisional', 'pagado', 'aprobado', 'rechazado']);
            $table->string('razon_rechazo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};
