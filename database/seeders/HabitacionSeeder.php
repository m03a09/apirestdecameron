<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HabitacionSeeder extends Seeder
{
    public function run(): void
    {
        $hoteles = DB::table('hoteles')->get();
        $tiposHabitacion = DB::table('tipos_habitacion')->pluck('id', 'nombre');
        $acomodaciones = DB::table('acomodaciones')->pluck('id', 'nombre');

        foreach ($hoteles as $hotel) {
            DB::table('habitaciones')->insert([
                [
                    'hotel_id' => $hotel->id,
                    'tipo_habitacion_id' => $tiposHabitacion['Estándar'],
                    'acomodacion_id' => $acomodaciones['Sencilla'],
                    'cantidad' => 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'hotel_id' => $hotel->id,
                    'tipo_habitacion_id' => $tiposHabitacion['Junior'],
                    'acomodacion_id' => $acomodaciones['Doble'],
                    'cantidad' => 8,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'hotel_id' => $hotel->id,
                    'tipo_habitacion_id' => $tiposHabitacion['Suite'],
                    'acomodacion_id' => $acomodaciones['Triple'],
                    'cantidad' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
