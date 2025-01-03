<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Jugador;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jugador>
 */
class JugadorFactory extends Factory
{
    protected $model = Jugador::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'genero' => $this->faker->randomElement(['masculino', 'femenino']),
            'nivel_habilidad' => $this->faker->numberBetween(1, 100),
            'fuerza' => $this->faker->numberBetween(1, 100),
            'velocidad' => $this->faker->numberBetween(1, 100),
            'tiempo_reaccion' => $this->faker->numberBetween(1, 100),
        ];
    }
}
