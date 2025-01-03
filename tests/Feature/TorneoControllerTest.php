<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Torneo;

class TorneoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_return_a_list_of_completed_torneos()
    {
        // Preparar datos
        Torneo::factory()->create([
            'estado' => 'completado',
            'genero' => 'masculino',
            'fecha_jugado' => now(),
        ]);

        // Llamar al endpoint
        $response = $this->getJson('/api/torneo/listado');

        // Verificar respuesta
        $response->assertStatus(200)
            ->assertJsonStructure([
                'mensaje',
                'torneos' => [
                    '*' => ['id', 'genero', 'estado', 'fecha_jugado']
                ]
            ]);
    }

        /** @test */
        public function it_should_create_and_simulate_a_torneo()
        {
            // Preparar datos
            $jugadores = [
                ['nombre' => 'Jugador 1', 'genero' => 'masculino', 'nivel_habilidad' => 10],
                ['nombre' => 'Jugador 2', 'genero' => 'masculino', 'nivel_habilidad' => 15],
            ];

            $data = [
                'genero' => 'masculino',
                'jugadores' => $jugadores,
            ];

            // Llamar al endpoint
            $response = $this->postJson('/api/torneo/simular', $data);

            // Verificar respuesta
            $response->assertStatus(200)
                ->assertJsonStructure([
                    'mensaje',
                    'torneo' => [
                        'id',
                        'estado',
                        'genero',
                        'fecha_jugado',
                        'ganador_id',
                    ]
                ]);

            // Verificar estado en la base de datos
            $this->assertDatabaseHas('torneos', [
                'estado' => 'completado',
            ]);
        }

}
