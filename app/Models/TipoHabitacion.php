<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoHabitacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];
    protected $table = 'tipos_habitacion';

    public function habitaciones(): HasMany
    {
        return $this->hasMany(Habitacion::class);
    }
}
