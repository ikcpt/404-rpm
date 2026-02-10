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

// Ruta para acceder a la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Ruta para cargar la página de inicio de sesión
Route::get('/login', function() {
    return view('login');
})->name('login');

// Ruta para cargar la página de registro de un nuevo usuario
Route::get('/register', function() {
    return view('register');
})->name('register');

// Si cualquier usuario accede a esta ruta, se le redigirá a la página de inicio
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta para acceder al menú de inicio de sesión
Route::get('acceso', function () {
    return view('acceso');
})->name('acceso');

// Rutas de concesionario, para filtrar los coches según la marca, y buscar el modelo de cada coche con el buscador
Route::get('/concesionario', [CarController::class, 'concesionario'])->name('concesionario');

Route::get('/api/cars/{id}', function ($id) {
    $car = Car::with(['brand', 'extras'])->find($id);

    if (!$car) {
        return response()->json(['error' => 'Coche no encontrado'], 404);
    }

    // Laravel convierte esto automáticamente a JSON
    return response()->json($car);
});

Route::get('/ficha/{id}', function ($id) {
    return view('ficha', ['id' => $id]); 
})->name('ficha');

Route::get('/marca/{id}', [CarController::class, 'carsByBrand'])->name('marca.detalle');

Route::get('/pedir-cita', function () {
    $user = Auth::user();
    
    // 1. Obtenemos las citas
    $citas = App\Models\Cita::where('user_id', $user->id)->get();
    
    // 2. Obtenemos los coches
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
    //Cambiar la ruta para que sea /perfil en vez de /profile y quede todo mas limpio
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

    // Facturas
    //Cambiar la ruta para que funcione atraves de un controlador
    Route::get('/mis-facturas', function() {
        $user = Auth::user();
        $facturas = $user->facturas()->orderBy('fecha_emision', 'desc')->get();
        return view('mis-facturas', compact('user', 'facturas'));
    })->name('mis-facturas');

    // Citas
    //Cambiar la ruta para que funcione atraves de un controlador
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