<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable(false);
            $table->integer('nivel_habilidad')->unsigned(); // Nivel de habilidad (0-100)
            $table->enum('genero', ['masculino', 'femenino']); // Genero
            $table->integer('fuerza')->nullable(); // Solo para jugadores masculinos
            $table->integer('velocidad')->nullable(); // Solo para jugadores masculinos
            $table->integer('tiempo_reaccion')->nullable(); // Solo para jugadoras femeninas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};
