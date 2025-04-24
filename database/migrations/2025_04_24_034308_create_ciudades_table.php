<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiudadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        if (!Schema::hasTable('ciudades')) {
            Schema::create('ciudades', function (Blueprint $table) {
                $table->id();
                $table->string('nombre', 100);
                $table->timestamps(0);
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('ciudades');
    }
};