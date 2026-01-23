<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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
?>