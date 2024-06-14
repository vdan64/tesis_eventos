<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\solicitud>
 */
class SolicitudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake('es_VE');
        return [
            'N_solicitud' => $fake->randomNumber(),
            'cedula_solicitante' => $fake->nationalId(),
            'nombre_evento' => $fake->text(),
            'publicidad' => $fake->text(),
            'descripcion' => $fake->text(),
            'fecha_inspeccion' => now(),
            'fecha_solicitud' => now(),
            'permiso_provisional' => '',
            'permiso_definitivo' => '',
            'fecha_evento' => now(),
            'fecha_permisoprovisional' => now(),
            'fecha_permisodefinitivo' => now(),
            'id_inspector' => '',
            'cedula_aapp' => '',
            'cedula_dat' => '',
            'url_rif' => '',
            'url_permiso' => '',
            'numero_entradas' => $fake->randomNumber(),
            'numero_funciones' => $fake->randomNumber(),
            'aprobado' => $fake->boolean(),
        ];
    }
}
