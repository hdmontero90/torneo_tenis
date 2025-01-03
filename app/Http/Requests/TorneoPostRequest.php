<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TorneoPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

     /**
     * @OA\Schema(
     *     schema="TorneoRequest",
     *     type="object",
     *     required={"genero", "jugadores"},
     *     @OA\Property(property="genero", type="string", description="Género del torneo", enum={"masculino", "femenino"}),
     *     @OA\Property(
     *         property="jugadores",
     *         type="array",
     *         description="Lista de jugadores que participan en el torneo",
     *         @OA\Items(
     *             type="object",
     *             required={"nombre", "genero", "nivel_habilidad"},
     *             @OA\Property(property="nombre", type="string", description="Nombre del jugador"),
     *             @OA\Property(property="genero", type="string", description="Género del jugador", enum={"masculino", "femenino"}),
     *             @OA\Property(property="nivel_habilidad", type="integer", description="Nivel de habilidad del jugador"),
     *             @OA\Property(property="fuerza", type="integer", nullable=true, description="Fuerza del jugador"),
     *             @OA\Property(property="velocidad", type="integer", nullable=true, description="Velocidad del jugador"),
     *             @OA\Property(property="tiempo_reaccion", type="integer", nullable=true, description="Tiempo de reacción del jugador")
     *         )
     *     )
     * )
     */
    public function rules(): array
    {
        return [
            'genero' => 'required|string|in:masculino,femenino',
            'jugadores' => 'required|array',
            'jugadores.*.nombre' => 'required|string',
            'jugadores.*.genero' => 'required|in:masculino,femenino',
            'jugadores.*.nivel_habilidad' => 'required|numeric',
            'jugadores.*.fuerza' => 'nullable|numeric',
            'jugadores.*.velocidad' => 'nullable|numeric',
            'jugadores.*.tiempo_reaccion' => 'nullable|numeric',
        ];
    }
}

