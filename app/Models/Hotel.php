<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'nit',
        'ciudad_id',
        'numero_habitaciones',
    ];
    protected $table = 'hoteles';

    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function habitaciones(): HasMany
    {
        return $this->hasMany(Habitacion::class);
    }
}
