<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposHabitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        if (!Schema::hasTable('tipos_habitacion')) {
            Schema::create('tipos_habitacion', function (Blueprint $table) {
                $table->id();
                $table->string('nombre', 50)->unique();
                $table->timestamps(0);
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('tipos_habitacion');
    }
};