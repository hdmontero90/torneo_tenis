<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TorneoPostRequest;
use App\Models\Torneo;
use App\Models\Jugador;

class TorneoController extends Controller
{
    /**
     * Listado de torneos jugados
     */
    public function indexTorneo(Request $request)
    {
        // Busca los torneos que se encuentran en el estado completado
        // y puede ser filtrados desde parametros como el genero
        // y la fecha cuando se jugó
        $torneos = Torneo::where('estado', 'completado')
        ->when($request->fecha, function ($query, $fecha) {
            return $query->where('fecha_jugado', '>=', $fecha);
        })
        ->when($request->genero, function ($query, $genero) {
            return $query->where('genero', $genero);
        })
        ->with('jugadores', 'ganador')
        ->orderBy('fecha_jugado', 'desc')
        ->get();

        return response()->json([
            'mensaje' => 'Torneos jugados',
            'torneos' => $torneos
        ]);
    }

    /**
     * Creá el torneo y hace una simulación del mismo
     * devolviendo el torneo con el ganador y los jugadores
     * que participaron
     */
    public function crearTorneo(TorneoPostRequest $request): JsonResponse
    {
        // Crear el torneo
        $torneo = Torneo::create($request->all());

        // Asociar los jugadores al torneo
        $torneo->jugadores()->createMany($request->jugadores);

        // Obtener el torneo con los jugadores asociados y filtrados por género
        $torneo = $torneo->load(['jugadores' => function ($query) use ($torneo) {
            $query->where('genero', $torneo->genero);
        }]);

        // Obtiene los jugadores del torneo que se encuentran guardados en la base de datos
        $jugadores = $torneo['jugadores'];

        // Verifica que la cantidad de jugadores sea mayor que 1
        while (count($jugadores) > 1) {
            // Listado inicial de jugadores para la proxima ronda
            $siguienteRonda = [];

            // Recorre los jugadores, hace la simulación del partido y guarda el ganador en
            // el listado inicial de los jugadores para la proxima ronda
            for ($i = 0; $i < count($jugadores); $i += 2) {
                $ganador = $this->simularPartido($jugadores[$i], $jugadores[$i + 1], $torneo->genero);
                $siguienteRonda[] = $ganador;
            }
            // Remplaza los jugadores iniciales por los que ganaron los partidos
            $jugadores = $siguienteRonda;
        }

        // Modifica el atributo ganador_id por el ID del jugador que gano el torneo
        $torneo->ganador_id = $jugadores[0]['id'];
        // Modifica el atributo estado por el estado completado luego de terminar el torneo
        $torneo->estado = 'completado';
        // Modifica el atributo fecha_jugado por la fecha actual que se jugo el torneo
        $torneo->fecha_jugado = now();
        // Guarda el torneo jugado
        $torneo->save();

        // Devuelve en formato JSON un mensaje y los datos del torneo
        return response()->json([
            'mensaje' => 'Torneo creado exitosamente.',
            'torneo' => $torneo
        ]);
    }

    /**
     * Simula el partido de tenis ingresando el genero del torneo
     * y sus dos participantes
     */
    private function simularPartido(Jugador $jugador1, Jugador $jugador2, string $genero)
    {
        $puntaje1 = $jugador1->nivel_habilidad + rand(0, 10);
        $puntaje2 = $jugador2->nivel_habilidad + rand(0, 10);

        if ($genero === 'masculino') {
            $puntaje1 += $jugador1->fuerza + $jugador1->velocidad;
            $puntaje2 += $jugador2->fuerza + $jugador2->velocidad;
        } elseif ($genero === 'femenino') {
            $puntaje1 += $jugador1->tiempo_reaccion;
            $puntaje2 += $jugador2->tiempo_reaccion;
        }

        return $puntaje1 > $puntaje2 ? $jugador1 : $jugador2;
    }
}