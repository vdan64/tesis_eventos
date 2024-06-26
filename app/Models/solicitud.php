<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\tributo;
use App\Models\Perfil;

class solicitud extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $attributes = [
        'nombre_evento' => '',
        'N_solicitud' => '',
        'cedula_solicitante' => '',
        'publicidad' => '',
        'descripcion' => '',
        'fecha_inspeccion' => '2024-05-13',
        'fecha_solicitud' => '2024-05-13',
        'permiso_provisional' => '',
        'permiso_definitivo' => '',
        'fecha_evento' => '2024-05-13',
        'fecha_permisoprovisional' => null,
        'fecha_permisodefinitivo' => null,
        'id_inspector' => '',
        'cedula_aapp' => '',
        'cedula_dat' => '',
        'numero_entradas' => 0,
        'numero_funciones' => 0,
        'estado' => 'pendiente',
        'razon_rechazo' => '',
    ];

    public function tributo(): HasOne {
        return $this->hasOne(tributo::class);
    }

    public function perfil(): BelongsTo {
        return $this->BelongsTo(Perfil::class);
    }

}
