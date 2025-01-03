<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{

    // Especificar el nombre de la tabla
    protected $table = 'torneos';

    // Atributos de la tabla
    protected $fillable = [
        'genero',
        'estado',
        'ganador_id',
        'fecha_jugado',
    ];

    // Obtiene los jugadores del torneo
    public function jugadores()
    {
        return $this->belongsToMany(Jugador::class, 'torneo_jugador');
    }

    // Obtiene el jugador ganador
    public function ganador()
    {
        return $this->belongsTo(Jugador::class, 'ganador_id');
    }

}
