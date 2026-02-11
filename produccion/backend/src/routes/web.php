<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ComparacionController;
use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function() { return view('login'); })->name('login');
Route::get('/register', function() { return view('register'); })->name('register');
Route::get('acceso', function () { return view('acceso'); })->name('acceso');

Route::get('/concesionario', [CarController::class, 'concesionario'])->name('concesionario');

Route::get('/ficha/{id}', [CarController::class, 'show'])->name('ficha');
Route::get('/marca/{id}', [CarController::class, 'carsByBrand'])->name('marca.detalle');

Route::get('/pedir-cita', function () {
    $user = Auth::user();
    
    // 1. Obtenemos las citas
    $citas = App\Models\Cita::where('user_id', $user->id)->get();
    
    // 2. Obtenemos los coches
    $misCoches = $user->cars; 

    // 3. Enviamos AMBAS variables a la vista
    return view('cita', compact('citas', 'misCoches'));
})->middleware('auth')->name('pedir-cita');

Route::get('/cita', [CitaController::class, 'create'])->name('cita.create');
Route::post('/cita', [CitaController::class, 'store'])->name('citas.store');

// Rutas del perfil
Route::middleware('auth')->group(function () {
    // Ruta para cambiar la configuración del perfil
    Route::get('configuracion', [ProfileController::class, 'edit'])->name('configuracion');

    // Ruta para actualizar la información del perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Ruta para borrar información del perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
       
    // Perfil (Vista principal)
    Route::get('/perfil', function() {
        $user = Auth::user()->load('profile', 'cars.brand'); 
        
        $citaActiva = App\Models\Cita::where('user_id', $user->id)
                        ->whereNotIn('estado', ['Finalizada', 'Cancelada'])
                        ->with('car.brand')
                        ->latest('fecha')
                        ->first();

            // Pasamos la variable $citaActiva a la vista
            return view('perfil', compact('user', 'citaActiva'));
        })->name('perfil');
    
    // Rutas para la COMPRA:
    Route::post('/coche/{car}/comprar', [CarController::class, 'comprar'])->name('coche.comprar');

    // Rutas para la RESERVA:
    // 1. Mostrar el formulario (GET)
    Route::get('/coche/{car}/reservar', [CarController::class, 'mostrarFormularioReserva'])->name('coche.reservar.form');
    
    // 2. Procesar el formulario (POST)
    Route::post('/coche/{car}/reservar', [CarController::class, 'procesarReserva'])->name('coche.reservar.proceso');
    Route::post('/coche/{car}/finalizar', [CarController::class, 'finalizarReserva'])->name('coche.finalizar');
    // Facturas
    Route::get('/mis-facturas', function() {
        $user = Auth::user();
        $facturas = $user->facturas()->orderBy('fecha_emision', 'desc')->get();
        return view('mis-facturas', compact('user', 'facturas'));
    })->name('mis-facturas');

    // Citas

Route::get('/mis-citas', function () {
    $user = Auth::user();
    
    // Obtenemos historial
    $citas = App\Models\Cita::where('user_id', $user->id)->get();
    $misCoches = $user->cars; 

    // Retornamos la vista que renombraste a 'Mis-citas.blade.php'
    return view('profile.Mis-citas', compact('citas', 'misCoches'));

})->name('mis-citas');


});

// Grupo protegido: solo usuarios logueados pueden usar comparador
Route::middleware('auth')->group(function () {
    // Página del comparador
    Route::get('/comparacion', [ComparacionController::class, 'index'])->name('comparacion');
    Route::post('/comparacion', [ComparacionController::class, 'store'])->name('comparacion.store');
    Route::get('/mis-comparaciones', [ComparacionController::class, 'showUserComparisons'])->name('mis.comparaciones');
    Route::get('/comparacion/{id}', [ComparacionController::class, 'show']);
});

// --- RUTA COMODÍN (Assets) ---
Route::get('{any}', function ($filename) {
    $path = base_path('../frontend/' . $filename);
    if (!File::exists($path)) { abort(404); }
    
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);
    return $response;
})->where('any', '.*');

require __DIR__.'/auth.php';