<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Torneo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Torneo>
 */
class TorneoFactory extends Factory
{
    protected $model = Torneo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'genero' => $this->faker->randomElement(['masculino', 'femenino']),
            'estado' => 'completado',
            'ganador_id' => null,
            'fecha_jugado' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
