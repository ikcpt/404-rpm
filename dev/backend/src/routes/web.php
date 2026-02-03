<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Brand;

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
    return view('acceso');
})->name('acceso');

Route::get('/concesionario', function () {
    $brands = Brand::all();

    // Obtenemos los coches separándolos por su clase y cargando la marca para optimizar
    $gamaAlta  = Car::where('class', 'Gama Alta')->with('brand')->get();
    $gamaMedia = Car::where('class', 'Gama Media')->with('brand')->get();
    $ocasion   = Car::where('class', 'Ocasión')->with('brand')->get();

    return view('concesionario', compact('brands', 'gamaAlta', 'gamaMedia', 'ocasion'));
})->name('concesionario');

Route::get('/api/cars/{id}', function ($id) {
    // Buscamos el coche, su marca y sus extras
    $car = Car::with(['brand', 'extras'])->find($id);

    // Laravel convierte esto automáticamente a JSON
    return response()->json($car);
});

// 2. RUTA DE LA FICHA (Solo carga el esqueleto HTML y pasa el ID)
Route::get('/ficha/{id}', function ($id) {
    // Solo pasamos el ID a la vista, NO el coche entero.
    // El JS se encargará de buscar los datos usando el ID.
    return view('ficha', ['id' => $id]); 
})->name('ficha');

Route::get('/marca/{id}', [CarController::class, 'carsByBrand'])->name('marca.detalle');

// Middleware de autenticación. Las rutas que están dentro funcionarán si el usuario ha iniciado sesión
Route::get('/factura/{id}', function ($id) {
    return "Aquí se descargará la factura " . $id;
})->name('invoice');

// Rutas del perfil
Route::middleware('auth')->group(function () {
    // Ruta para cambiar la configuración del perfil
    Route::get('/configuracion', [ProfileController::class, 'edit'])->name('configuracion');

    // Ruta para actualizar la información del perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Ruta para borrar información del perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Ruta para cargar la página de perfil
Route::middleware('auth')->group(function () {
    
    // ... tus otras rutas (configuracion, update, destroy) ...
    Route::get('configuracion', [ProfileController::class, 'edit'])->name('configuracion');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 1. RUTA PERFIL (Ya no carga facturas, solo usuario y coches)
    Route::get('/perfil', function() {
        $user = Auth::user()->load('profile', 'cars.brand'); 
        return view('perfil', compact('user'));
    })->name('perfil');

    // 2. NUEVA RUTA SOLO PARA FACTURAS
    Route::get('/mis-facturas', function() {
        $user = Auth::user();
        // Aquí sí cargamos las facturas
        $facturas = $user->facturas()->orderBy('fecha_emision', 'desc')->get();
        return view('mis-facturas', compact('user', 'facturas'));
    })->name('mis-facturas');

});
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