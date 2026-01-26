<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Ruta que realiza la petición a la API del tiempo Open Meteo, donde se le pasan las coordenadas de Irún. Devuelve un JSON con los datos recibidos
Route::get('/clima', function() {
    $lat = 43.3390;
    $lon = -1.7894;

    $respuesta = Http::get('https://api.open-meteo.com/v1/forecast', [
        'latitude' => $lat,
        'longitude' => $lon,
        'current_weather' => true,
        'timezone' => 'auto'
    ]);

    return $respuesta->json();
});

// Ruta del middleware para gestionar si el usuario ha iniciado sesión o no
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
?>