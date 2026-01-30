<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;

// Ruta para cargar la página de inicio, redirige al usuario automáticamente a index.html del frontend
Route::get('/', [HomeController::class, 'index']
)->name('home');

// Ruta para inciar sesión
Route::get('/login', function() {
    return view('login');
})->name('login');

// Ruta para registrar un nuevo usuario
Route::get('/register', function() {
    return view('register');
})->name('register');

// Si accede a /dashboard, se redigirá automáticamente al usuario a la página de incio
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta para acceder al menú de inicio de sesión
Route::get('/acceso', function () {
    return view('portal');
})->name('portal');

Route::get('/concesionario', function () {
    // Obtenemos los coches separándolos por su clase y cargando la marca para optimizar
    $gamaAlta  = Car::where('class', 'Gama Alta')->with('brand')->get();
    $gamaMedia = Car::where('class', 'Gama Media')->with('brand')->get();
    $ocasion   = Car::where('class', 'Ocasión')->with('brand')->get();

    return view('concesionario', compact('gamaAlta', 'gamaMedia', 'ocasion'));
})->name('concesionario');

Route::get('/api/cars/{id}', function ($id) {
    // Buscamos el coche, su marca y sus extras
    $car = Car::with(['brand', 'extras'])->find($id);

    if (!$car) {
        return response()->json(['error' => 'Coche no encontrado'], 404);
    }

    // Laravel convierte esto automáticamente a JSON
    return response()->json($car);
});

// 2. RUTA DE LA FICHA (Solo carga el esqueleto HTML y pasa el ID)
Route::get('/ficha/{id}', function ($id) {
    // Solo pasamos el ID a la vista, NO el coche entero.
    // El JS se encargará de buscar los datos usando el ID.
    return view('ficha', ['id' => $id]); 
})->name('ficha');

// Rutas del perfil
Route::middleware('auth')->group(function () {
    // Ruta para cambiar la configuración del perfil
    Route::get('configuracion', [ProfileController::class, 'edit'])->name('configuracion');

    // Ruta para actualizar la información del perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Ruta para borrar información del perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Ruta para cargar la página de perfil
    Route::get('/perfil', function() {
        // Se guarda el usuario que ha iniciado sesión en la variable $user, con su perfil y sus coches
        $user = Auth::user()->load('profile', 'cars.brand');

        // Devolvemos la vista "perfil.blade.php" y la informacion de $user
        return view('perfil', compact('user'));
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