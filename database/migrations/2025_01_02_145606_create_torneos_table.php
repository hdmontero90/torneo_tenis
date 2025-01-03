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
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->enum('genero', ['masculino', 'femenino']); // Tipo de torneo (masculino o femenino)
            $table->string('estado')->default('pendiente'); // Estado del torneo
            $table->foreignId('ganador_id')->nullable()->constrained('jugadores')->onDelete('set null'); // Agrega la columna 'ganador_id' como foreign key
            $table->timestamp('fecha_jugado')->nullable(); // Fecha en la que se juega el torneo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};
