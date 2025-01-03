<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    // Especificar el nombre de la tabla
    protected $table = 'jugadores';

    // Atributos de la tabla
    protected $fillable = [
        'nombre',
        'genero',
        'nivel_habilidad',
        'fuerza',
        'velocidad',
        'tiempo_reaccion',
    ];

}
