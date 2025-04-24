<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Acomodacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];
    protected $table = 'acomodaciones';

    public function habitaciones(): HasMany
    {
        return $this->hasMany(Habitacion::class);
    }
}
