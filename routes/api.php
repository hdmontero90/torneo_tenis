<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TorneoController;

Route::prefix('torneo')->group(function () {
    Route::get('/listado',  [TorneoController::class, 'indexTorneo']);
    Route::post('/simular',  [TorneoController::class, 'crearTorneo']);
});
