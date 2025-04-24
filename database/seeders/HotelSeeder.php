<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $ciudadCartagena = DB::table('ciudades')->where('nombre', 'Cartagena')->first();
        $ciudadSanAndres = DB::table('ciudades')->where('nombre', 'San Andrés')->first();

        if ($ciudadCartagena && $ciudadSanAndres) {
            DB::table('hoteles')->insert([
                [
                    'nombre' => 'DECAMERON CARTAGENA',
                    'direccion' => 'Calle 23 58-25',
                    'nit' => '12345678-9',
                    'ciudad_id' => $ciudadCartagena->id,
                    'numero_habitaciones' => 42,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nombre' => 'DECAMERON ISLA',
                    'direccion' => 'Av. New Wave 15',
                    'nit' => '98765432-1',
                    'ciudad_id' => $ciudadSanAndres->id,
                    'numero_habitaciones' => 30,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
