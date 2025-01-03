<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Jugador",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="nombre", type="string"),
 *     @OA\Property(property="genero", type="string"),
 *     @OA\Property(property="nivel_habilidad", type="integer"),
 *     @OA\Property(property="fuerza", type="integer", nullable=true),
 *     @OA\Property(property="velocidad", type="integer", nullable=true),
 *     @OA\Property(property="tiempo_reaccion", type="integer", nullable=true)
 * )
 */
class Jugador extends Model
{
    use HasFactory;

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
