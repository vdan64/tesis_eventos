<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\solicitud;
use App\Models\perfil;

class inspeccion extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'ID_supervisor' => 1,
        'N_solicitud' => '',
        'descripcion' => '',
        'fecha_inspeccion' => '2024-03-10',
        'procede_multa' => '',
        'cedula' => '',
    ];

    public function solicitud(): BelongsTo {
        return $this->belongsTo(solicitud::class);
    }

    public function perfil(): BelongsTo {
        return $this->belongsTo(Perfil::class);
    }
}
