<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Brand;
use App\Models\Extra;
use App\Models\Car;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // Usuarios
        $userAdmin = User::create(['name' => 'Admin Boss', 'email' => 'admin@404rpm.com', 'password' => '1234']);
        Profile::create(['user_id' => $userAdmin->id, 'surname' => 'System', 'phone' => '600000001', 'address' => 'Oficina Central']);

        $userCarlos = User::create(['name' => 'Carlos', 'email' => 'carlos.vip@email.com', 'password' => '1234']);
        Profile::create(['user_id' => $userCarlos->id, 'surname' => 'Slim', 'phone' => '600999888', 'address' => 'La Finca, Madrid']);

        $userLaura = User::create(['name' => 'Laura', 'email' => 'laura.racing@email.com', 'password' => '1234']);
        Profile::create(['user_id' => $userLaura->id, 'surname' => 'Gómez', 'phone' => '611223344', 'address' => 'Valencia Centro']);

        $userDavid = User::create(['name' => 'David', 'email' => 'david.padre@email.com', 'password' => '1234']);
        Profile::create(['user_id' => $userDavid->id, 'surname' => 'Fernández', 'phone' => '622334455', 'address' => 'Sevilla']);

        $userElena = User::create(['name' => 'Joan', 'email' => 'joan.new@email.com', 'password' => '1234']);
        Profile::create(['user_id' => $userElena->id, 'surname' => 'Vázquez', 'phone' => '633445566', 'address' => 'Barcelona']);

        $userJuan = User::create(['name' => 'Juan Pérez', 'email' => 'juan.perez@email.com', 'password' => '1234']);
        Profile::create(['user_id' => $userJuan->id, 'surname' => 'Pérez', 'phone' => '644556677', 'address' => 'Bilbao']);

        // Marcas
        $brandFord = Brand::create(['name' => 'Ford', 'country' => 'Estados Unidos']);
        $brandAudi = Brand::create(['name' => 'Audi', 'country' => 'Alemania']);
        $brandPorsche = Brand::create(['name' => 'Porsche', 'country' => 'Alemania']);
        $brandFerrari = Brand::create(['name' => 'Ferrari', 'country' => 'Italia']);
        $brandBMW = Brand::create(['name' => 'BMW', 'country' => 'Alemania']);
        $brandMercedes = Brand::create(['name' => 'Mercedes-Benz', 'country' => 'Alemania']);
        $brandVW = Brand::create(['name' => 'Volkswagen', 'country' => 'Alemania']);
        $brandMini = Brand::create(['name' => 'Mini', 'country' => 'Alemania']);
        $brandSeat = Brand::create(['name' => 'Seat', 'country' => 'Alemania']);
        $brandToyota = Brand::create(['name' => 'Toyota', 'country' => 'Japón']);

        // Extras
        $exGPS = Extra::create(['name' => 'Navegador', 'description' => 'Pantalla con mapas.']);
        $exTecho = Extra::create(['name' => 'Techo Solar', 'description' => 'Techo abatible.']);
        $exCuero = Extra::create(['name' => 'Cuero', 'description' => 'Asientos de piel.']);
        $exSport = Extra::create(['name' => 'Pack Sport', 'description' => 'Suspensiones y escape deportivo.']);
        $exAudio = Extra::create(['name' => 'Audio Premium', 'description' => 'Sistema de sonido envolvente.']);
        $exLed = Extra::create(['name' => 'Faros LED Matrix', 'description' => 'Iluminación inteligente.']);

       // Coches
        $car = Car::create([
    'brand_id' => $brandFerrari->id,
    'user_id' => $userCarlos->id,
    'model' => 'F8 Tributo',
    'type' => 'Gasolina',
    'description' => 'Deportivo de alto rendimiento con motor V8, aerodinámica avanzada y diseño exclusivo de Ferrari.',
    'price' => 285000.00,
    'image' => 'assets/img/ferrari/f8-tributo.png'
]);

$car = Car::create([
    'brand_id' => $brandLamborghini->id,
    'user_id' => $userLaura->id,
    'model' => 'Huracán',
    'type' => 'Gasolina',
    'description' => 'Superdeportivo italiano con motor V10, tracción integral y diseño agresivo de Lamborghini.',
    'price' => 240000.00,
    'image' => 'assets/img/lamborguini/huracan.png'
]);

$car = Car::create([
    'brand_id' => $brandAudi->id,
    'user_id' => $userDavid->id,
    'model' => 'R8 V10',
    'type' => 'Gasolina',
    'description' => 'Coupé deportivo con motor V10 de altas prestaciones, tracción integral quattro y diseño elegante.',
    'price' => 145000.00,
    'image' => 'assets/img/audi/r8.png'
]);

// **Gama Media**
$car = Car::create([
    'brand_id' => $brandBMW->id,
    'user_id' => null,
    'model' => 'M4 Competition',
    'type' => 'Gasolina',
    'description' => 'Coupé deportivo con motor S58, 510 CV, suspensión adaptativa y tecnología M avanzada.',
    'price' => 92000.00,
    'image' => 'assets/img/bmw/m4-competition.png'
]);

$car = Car::create([
    'brand_id' => $brandMercedes->id,
    'user_id' => null,
    'model' => 'C63 AMG',
    'type' => 'Gasolina',
    'description' => 'Deportivo alemán con motor V8, 476 CV, chasis reforzado y tecnología AMG.',
    'price' => 85000.00,
    'image' => 'assets/img/mercedes/c63-amg.png'
]);

$car = Car::create([
    'brand_id' => $brandAudi->id,
    'user_id' => null,
    'model' => 'RS3 Avant',
    'type' => 'Gasolina',
    'description' => 'Familiar deportivo con motor turbo, 400 CV, tracción quattro y acabados premium.',
    'price' => 68000.00,
    'image' => 'assets/img/audi/rs3-avant.png'
]);

// **Gama Baja / Ocasión**
$car = Car::create([
    'brand_id' => $brandVW->id,
    'user_id' => null,
    'model' => 'Golf GTI',
    'type' => 'Gasolina',
    'description' => 'Hatchback deportivo clásico, motor 2.0 TSI, diseño icónico y rendimiento sólido.',
    'price' => 22500.00,
    'image' => 'assets/img/VW/gti.png'
]);

$car = Car::create([
    'brand_id' => $brandMini->id,
    'user_id' => null,
    'model' => 'Mini Cooper S',
    'type' => 'Gasolina',
    'description' => 'Clásico urbano con motor turbo, estilo retro y conducción divertida.',
    'price' => 18900.00,
    'image' => 'assets/img/mini/mini-chope.png'
]);

$car = Car::create([
    'brand_id' => $brandSeat->id,
    'user_id' => null,
    'model' => 'Leon',
    'type' => 'Gasolina',
    'description' => 'Compacto español, diseño moderno, motor eficiente y equipamiento tecnológico.',
    'price' => 20000.00,
    'image' => 'assets/img/seat/seta-leon.png'
]);
          /*
        |--------------------------------------------------------------------------
        | 7. REVIEWS
        |--------------------------------------------------------------------------
        */
        $reviews = [
            ['rating' => 5, 'content' => 'Excelente servicio.'],
            ['rating' => 4, 'content' => 'Buen trato, algo lentos.'],
            ['rating' => 3, 'content' => 'Correcto sin más.'],
            ['rating' => 5, 'content' => 'Grandes profesionales.'],
        ];

        foreach ($reviews as $review) {
            DB::table('reviews')->insert([
                'user_id' => User::inRandomOrder()->first()->id,
                'rating' => $review['rating'],
                'content' => $review['content'],
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]);
        }
    }
}