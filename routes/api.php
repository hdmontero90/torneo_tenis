<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TorneoController;
use L5Swagger\Http\Controllers\SwaggerController;

Route::get('/api/documentation', [SwaggerController::class, 'api'])->name('l5-swagger.default.api');

Route::prefix('torneo')->group(function () {
    Route::get('/listado',  [TorneoController::class, 'indexTorneo']);
    Route::post('/simular',  [TorneoController::class, 'crearTorneo']);
});
