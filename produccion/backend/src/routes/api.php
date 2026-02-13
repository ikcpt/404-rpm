<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CarController;
use App\Models\Car;
use App\Models\Review;

Route::get('/cars/{id}', function ($id) {
    $car = Car::with(['brand', 'extras'])->find($id);

    if (!$car) {
        return response()->json(['error' => 'Coche no encontrado'], 404);
    }

    return response()->json($car);
});

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

// Endpoint de reseñas
Route::get('/reviews', function () {
    // Busca todas las reseñas, incluye los datos del usuario (autor) y ordena por fecha
    $reviews = Review::with('user')->latest()->get();
    
    return response()->json($reviews);
});

Route::apiResource('cars', CarController::class);

// Ruta del middleware para gestionar si el usuario ha iniciado sesión o no
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
?>