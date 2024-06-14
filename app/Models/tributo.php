<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\solicitud;

class tributo extends Model
{ 
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'idpago' => '', 
        'Nsolicitud' => '', 
        'descripcion' => '',    
        'tipo' => 0,   
        'cuenta_destino' => '', 
        'fechapago' => null,  
        'monto' => 0.0,  
        'confirmado' => false,  
    ];

    public function solicitud(): BelongsTo {
        return $this->belongsTo(solicitud::class);
    }
}
