<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ciudad extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];
    protected $table = 'ciudades';

    public function hoteles(): HasMany
    {
        return $this->hasMany(Hotel::class);
    }
}
