<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Habitacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'tipo_habitacion_id',
        'acomodacion_id',
        'cantidad',
    ];
    protected $table = 'habitaciones';

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function tipoHabitacion(): BelongsTo
    {
        return $this->belongsTo(TipoHabitacion::class, 'tipo_habitacion_id'); // Especificamos la clave foránea
    }

    public function acomodacion(): BelongsTo
    {
        return $this->belongsTo(Acomodacion::class);
    }
}
