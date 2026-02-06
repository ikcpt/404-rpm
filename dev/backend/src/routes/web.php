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
use App\Models\Car;
use App\Models\Brand;
use App\Models\Appointment;

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
    $brands = Brand::with('cars')->get();
    // Obtenemos los coches separándolos por su clase y cargando la marca para optimizar
    $gamaAlta  = Car::where('class', 'Gama Alta')->with('brand')->get();
    $gamaMedia = Car::where('class', 'Gama Media')->with('brand')->get();
    $ocasion   = Car::where('class', 'Ocasión')->with('brand')->get();

    return view('concesionario', compact('brands', 'gamaAlta', 'gamaMedia', 'ocasion'));
})->name('concesionario');

// Route::get('/api/cars/{id}', function ($id) {
//     $car = \App\Models\Car::with(['brand', 'extras'])->find($id);

//     if (!$car) {
//         return response()->json(['error' => 'Coche no encontrado'], 404);
//     }

//     return response()->json($car);
// });

Route::get('/ficha/{id}', [CarController::class, 'show'])->name('ficha');

Route::get('/marca/{id}', [CarController::class, 'carsByBrand'])->name('marca.detalle');

// Middleware de autenticación. Las rutas que están dentro funcionarán si el usuario ha iniciado sesión
Route::get('/factura/{id}', function ($id) {
    return "Aquí se descargará la factura " . $id;
})->name('invoice');



Route::get('/pedir-cita', function () {
    $user = Auth::user();
    
    // 1. Obtenemos las citas
    $citas = App\Models\Cita::where('user_id', $user->id)->get();
    
    // 2. Obtenemos los coches (ESTO ES LO QUE FALTABA)
    $misCoches = $user->cars; 

    // 3. Enviamos AMBAS variables a la vista
    return view('cita', compact('citas', 'misCoches'));
})->name('pedir-cita');

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
            
            // BUSCAMOS SI HAY UN COCHE EN EL TALLER
            // Buscamos una cita que NO esté finalizada ni cancelada
            $citaActiva = App\Models\Cita::where('user_id', $user->id)
                            ->whereNotIn('estado', ['Finalizada', 'Cancelada'])
                            ->with('car.brand') // Cargamos datos del coche y la marca
                            ->latest('fecha')   // Si hay varias, cogemos la más reciente
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

})->name('mis-citas'); // <--- Nombre correcto para el historial


});

// Grupo protegido: solo usuarios logueados pueden usar comparador
Route::middleware('auth')->group(function () {
    // Página del comparador
    Route::get('/comparacion', [ComparacionController::class, 'index'])->name('comparacion');

    // Guardar una nueva comparación
    Route::post('/comparacion', [ComparacionController::class, 'store'])->name('comparacion.store');

    // Ver las comparaciones del usuario
    Route::get('/mis-comparaciones', [ComparacionController::class, 'showUserComparisons'])->name('mis.comparaciones');

    // Datos JSON de un coche individual (para arrastrar y soltar)
    Route::get('/comparacion/{id}', [ComparacionController::class, 'show']);
});




// --- RUTA COMODÍN ---
// Esta ruta captura cualquier URL que no coincida con las anteriores.

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