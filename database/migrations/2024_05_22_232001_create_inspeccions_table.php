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
        Schema::create('inspeccions', function (Blueprint $table) {
            $table->foreignId('perfil_id');
            $table->id();
            $table->timestamps();
            $table->integer('ID_supervisor');
            $table->string('N_solicitud');
            $table->text('descripcion');
            $table->date('fecha_inspeccion');
            $table->string('procede_multa');
            $table->string('cedula');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspeccions');
    }
};
