<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Appointment;
use App\Http\Controllers\CitaController;

// --- RUTAS PÚBLICAS ---

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

Route::get('acceso', function () {
    return view('acceso');
})->name('acceso');

Route::get('/concesionario', function () {
    $gamaAlta  = Car::where('class', 'Gama Alta')->with('brand')->get();
    $gamaMedia = Car::where('class', 'Gama Media')->with('brand')->get();
    $ocasion   = Car::where('class', 'Ocasión')->with('brand')->get();

    return view('concesionario', compact('gamaAlta', 'gamaMedia', 'ocasion'));
})->name('concesionario');

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

Route::get('/factura/{id}', function ($id) {
    return "Aquí se descargará la factura " . $id;
})->name('invoice');

Route::get('/cita', [CitaController::class, 'create'])->name('cita.create');
Route::post('/cita', [CitaController::class, 'store'])->name('citas.store');

// --- RUTAS PRIVADAS (Requieren Login) ---

Route::middleware('auth')->group(function () {
    
    // Configuración y Perfil (Controller)
    Route::get('configuracion', [ProfileController::class, 'edit'])->name('configuracion');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Perfil (Vista principal)
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

    // Citas (AQUÍ ES DONDE DEBE ESTAR)
    Route::get('/mis-citas', function () {
        $citas = Appointment::where('user_id', Auth::id())
            ->with('car') 
            ->orderBy('fecha', 'desc')
            ->get();
            
        return view('profile.citas', compact('citas'));
    })->name('mis-citas');

});


// --- RUTA COMODÍN (SIEMPRE AL FINAL) ---
// Esta ruta captura cualquier URL que no coincida con las anteriores.
// DEBE ser la última antes del require auth.php

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