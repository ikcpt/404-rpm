<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Brand;
use App\Models\Appointment;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CitaController; // Asegúrate de tener este import si usas CitaController
use App\Http\Controllers\ComparacionController; // Import del comparador movido arriba

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function() {
    return view('login');
})->name('login');

Route::get('/register', function() {
    return view('register');
})->name('register');

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta para acceder al menú de inicio de sesión
Route::get('acceso', function () {
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

// API simple existente (cuidado de no confundirla con la del comparador)
Route::get('/api/cars/{id}', function ($id) {
    $car = Car::with(['brand', 'extras'])->find($id);

    if (!$car) {
        return response()->json(['error' => 'Coche no encontrado'], 404);
    }
    return response()->json($car);
});

Route::get('/ficha/{id}', function ($id) {
    return view('ficha', ['id' => $id]); 
})->name('ficha');

Route::get('/marca/{id}', [CarController::class, 'carsByBrand'])->name('marca.detalle');

// Middleware de autenticación
Route::get('/factura/{id}', function ($id) {
    return "Aquí se descargará la factura " . $id;
})->name('invoice');

Route::get('/cita', [CitaController::class, 'create'])->name('cita.create');
Route::post('/cita', [CitaController::class, 'store'])->name('citas.store');

// --- RUTAS DEL COMPARADOR (NUEVAS) ---
// Vista principal
Route::get('/comparador', [ComparacionController::class, 'index'])->name('comparador.index');
// API para que el JavaScript cargue los datos (JSON)
Route::get('/comparador/api/coche/{id}', [ComparacionController::class, 'show'])->name('comparador.show');


// --- RUTAS DE PERFIL ---
Route::middleware('auth')->group(function () {
    // Configuración del perfil
    Route::get('configuracion', [ProfileController::class, 'edit'])->name('configuracion');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
    // Vista principal del perfil
    Route::get('/perfil', function() {
        $user = Auth::user()->load('profile', 'cars.brand'); 
        return view('perfil', compact('user'));
    })->name('perfil');

    // Facturas
    Route::get('/mis-facturas', function() {
        $user = Auth::user();
        $facturas = $user->facturas()->orderBy('fecha_emision', 'desc')->get();
        return view('mis-facturas', compact('user', 'facturas'));
    })->name('mis-facturas');

    // Citas
    Route::get('/mis-citas', function () {
        $user = Auth::user();
        $citas = \App\Models\Cita::where('user_id', $user->id)->get(); // He puesto el namespace completo por seguridad
        $misCoches = $user->cars; 
        return view('profile.citas', compact('citas', 'misCoches'));
    })->name('mis-citas');

});

// --- RUTA COMODÍN (Frontend Assets) ---
// IMPORTANTE: Esta ruta siempre debe ir AL FINAL DEL TODO
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