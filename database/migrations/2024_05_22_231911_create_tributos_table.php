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
        Schema::create('tributos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('solicitud_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('idpago')->nullable();
            $table->string('Nsolicitud');
            $table->string('descripcion');
            $table->integer('tipo');
            $table->string('cuenta_destino');
            $table->date('fechapago')->nullable();
            $table->double('monto');
            $table->boolean('confirmado');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tributos');
    }
};
