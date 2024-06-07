<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\tributo;
use App\Models\perfil;

class solicitud extends Model
{
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
        'fecha_evento' => '2024-05-13',
        'fecha_permisoprovisional' => '2024-05-13',
        'fecha_permisodefinitivo' => '2024-05-13',
        'id_inspector' => '',
        'cedula_aapp' => '',
        'cedula_dat' => '',
        'aprobado' => false,
    ];

    use HasFactory;

    public function tributo(): HasOne {
        return $this->hasOne(tributo::class);
    }

    public function perfil(): HasOne {
        return $this->BelongsTo(Perfil::class);
    }

}
