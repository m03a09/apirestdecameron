<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        if (!Schema::hasTable('habitaciones')) {
            Schema::create('habitaciones', function (Blueprint $table) {
                $table->id();
                $table->foreignId('hotel_id')->constrained('hoteles')->onDelete('cascade');
                $table->foreignId('tipo_habitacion_id')->constrained('tipos_habitacion');
                $table->foreignId('acomodacion_id')->constrained('acomodaciones');
                $table->integer('cantidad');
                $table->timestamps(0);

                $table->unique(
                    ['hotel_id', 'tipo_habitacion_id', 'acomodacion_id'],
                    'unique_hotel_tipo_acomodacion'
                );
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('habitaciones');
    }
};