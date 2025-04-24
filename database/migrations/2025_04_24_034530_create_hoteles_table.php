<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        if (!Schema::hasTable('hoteles')) {
            Schema::create('hoteles', function (Blueprint $table) {
                $table->id();
                $table->string('nombre', 100);
                $table->string('direccion', 255);
                $table->string('nit', 20);
                $table->foreignId('ciudad_id')->constrained('ciudades');
                $table->integer('numero_habitaciones');
                $table->timestamps(0);

                $table->unique(['nombre', 'nit'], 'unique_nombre_nit');
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('hoteles');
    }
};