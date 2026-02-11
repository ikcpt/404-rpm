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


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () { return redirect('/'); })->name('dashboard');

    Route::get('/perfil', function() {
        $user = Auth::user()->load('profile', 'cars.brand'); 
        
        $citaActiva = App\Models\Cita::where('user_id', $user->id)
                        ->whereNotIn('estado', ['Finalizada', 'Cancelada'])
                        ->with('car.brand')
                        ->latest('fecha')
                        ->first();

        return view('perfil', compact('user', 'citaActiva'));
    })->name('perfil');

    Route::get('configuracion', [ProfileController::class, 'edit'])->name('configuracion');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pedir-cita', [CitaController::class, 'create'])->name('pedir-cita'); 
    Route::post('/cita', [CitaController::class, 'store'])->name('citas.store');
    
    Route::get('/mis-citas', function () {
        $user = Auth::user();
        $citas = App\Models\Cita::where('user_id', $user->id)->get();
        $misCoches = $user->cars; 
        return view('profile.Mis-citas', compact('citas', 'misCoches'));
    })->name('mis-citas');

    
    Route::get('/mis-facturas', function() {
        $user = Auth::user();
        $facturas = $user->facturas()->orderBy('fecha_emision', 'desc')->get();
        return view('mis-facturas', compact('user', 'facturas'));
    })->name('mis-facturas');

    Route::post('/coche/{car}/comprar', [CarController::class, 'comprar'])->name('coche.comprar');
    Route::get('/coche/{car}/reservar', [CarController::class, 'mostrarFormularioReserva'])->name('coche.reservar.form');
    Route::post('/coche/{car}/reservar', [CarController::class, 'procesarReserva'])->name('coche.reservar.proceso');
    Route::post('/coche/{car}/finalizar', [CarController::class, 'finalizarReserva'])->name('coche.finalizar');

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