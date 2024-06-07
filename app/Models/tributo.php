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
    public function solicitud(): BelongsTo {
        return $this->belongsTo(solicitud::class);
    }
}
