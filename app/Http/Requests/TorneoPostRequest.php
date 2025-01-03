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

