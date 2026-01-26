<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

// Ruta para cargar la página de inicio, redirige al usuario automáticamente a index.html del frontend
Route::get('/', function () {
    $path = base_path('../frontend/index.html');

    if (!File::exists($path)) {
        return "Error: No se encuentra el archivo en " . $path;
    }
    return response()->file($path);
});

// Ruta para inciar sesión
Route::get('login', function() {
    return view('login');
})->name('login');

// Ruta para registrar un nuevo usuario
Route::get('register', function() {
    return view('register');
})->name('register');

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas para el middleware de Breeze para la autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Ruta para cargar la página de perfil
    Route::get('/perfil', function() {
        return view('perfil');
    })->name('perfil');
});

// Ruta que muestra la página de Error 404 si no se encuentra la página indicada
Route::get('{any}', function ($filename) {
    $path = base_path('../frontend/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
})->where('any', '.*');

require __DIR__.'/auth.php';
