<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\inspeccion;
use App\Models\solicitud;




class Perfil extends Model
{
    use HasFactory; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'nombre',
    //     'mail',
    //     'direccion',
    //     'telefono',
    //     'cedula',
    //     'rif',
    // ];

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',

        ];
    }




    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function inspecciones(): HasMany
    {
        return $this->hasMany(inspeccion::class);
    }

    public function solicitudes(): HasMany
    {
        return $this->hasMany(solicitud::class);
    }



}
