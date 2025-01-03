<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *     schema="Torneo",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="genero", type="string"),
 *     @OA\Property(property="estado", type="string"),
 *     @OA\Property(property="ganador_id", type="integer"),
 *     @OA\Property(property="fecha_jugado", type="string", format="date"),
 *     @OA\Property(property="jugadores", type="array",
 *         @OA\Items(ref="#/components/schemas/Jugador")
 *     )
 * )
 */
class Torneo extends Model
{
    use HasFactory;

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
