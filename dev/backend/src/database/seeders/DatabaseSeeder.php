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

        $userElena = User::create(['name' => 'Elena', 'email' => 'elena.new@email.com', 'password' => '1234']);
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
            'model' => 'SF90 Stradale', 
            'type' => 'Híbrido', 
            'description' => 'Superdeportivo híbrido.', 
            'price' => 550000.00,
            'image' => 'assets/img/ferrari/sf90.png'
        ]);
        $car->extras()->attach([$exCuero->id, $exSport->id]);
        
        $car = Car::create([
            'brand_id' => $brandBMW->id, 
            'user_id' => $userLaura->id, 
            'model' => 'M4 Competition', 
            'type' => 'Gasolina', 
            'description' => 'Coupé deportivo.', 
            'price' => 115000.00,
            'image' => 'assets/img/bmw/m4-competition.png'
        ]);
        $car->extras()->attach([$exSport->id, $exGPS->id]);

        $car = Car::create([
            'brand_id' => $brandAudi->id, 
            'user_id' => $userDavid->id, 
            'model' => 'Q7 TDI', 
            'type' => 'Diesel', 
            'description' => 'SUV familiar 7 plazas.', 
            'price' => 85000.00,
            'image' => 'assets/img/audi/q7.png'
        ]);
        $car->extras()->attach([$exTecho->id, $exAudio->id]);

        $car = Car::create([
            'brand_id' => $brandToyota->id, 
            'user_id' => $userJuan->id, 
            'model' => 'Corolla', 
            'type' => 'Híbrido', 
            'description' => 'Fiable y bajo consumo.', 
            'price' => 24000.00,
            'image' => 'assets/img/toyota/corolla.png'
        ]);

        Car::create([
            'brand_id' => $brandSeat->id, 
            'user_id' => null, 
            'model' => 'Ibiza FR', 
            'type' => 'Gasolina', 
            'description' => 'Ideal para ciudad. Acabado deportivo FR.', 
            'price' => 18500.00,
            'image' => 'assets/img/seat/ibiza.png'
        ])->extras()->attach([$exLed->id]);

        Car::create([
            'brand_id' => $brandFord->id, 
            'user_id' => null, 
            'model' => 'Focus ST-Line', 
            'type' => 'Diesel', 
            'description' => 'Compacto con muy bajo consumo.', 
            'price' => 22900.00,
            'image' => 'assets/img/ford/focus.jpg'
        ]);

        Car::create([
            'brand_id' => $brandToyota->id, 
            'user_id' => null, 
            'model' => 'Yaris Hybrid', 
            'type' => 'Híbrido', 
            'description' => 'El rey de la ciudad. Etiqueta ECO.', 
            'price' => 21000.00,
            'image' => 'assets/img/toyota/yaris.jpg'
        ]);

        Car::create([
            'brand_id' => $brandVW->id, 
            'user_id' => null, 
            'model' => 'Polo GTI', 
            'type' => 'Gasolina', 
            'description' => 'Pequeño pero matón. 207 CV.', 
            'price' => 32000.00,
            'image' => 'assets/img/VW/polo.png'
        ])->extras()->attach([$exSport->id]);

        Car::create([
            'brand_id' => $brandAudi->id, 
            'user_id' => null, 
            'model' => 'A3 Sportback', 
            'type' => 'Diesel', 
            'description' => 'Acabado S-Line. Elegante y práctico.', 
            'price' => 34500.00,
            'image' => 'assets/img/audi/a3.png'
        ])->extras()->attach([$exGPS->id, $exTecho->id]);

        Car::create([
            'brand_id' => $brandVW->id, 
            'user_id' => null, 
            'model' => 'Golf GTI 8', 
            'type' => 'Gasolina', 
            'description' => 'El compacto deportivo por excelencia.', 
            'price' => 46000.00,
            'image' => 'assets/img/VW/golf.png'
        ])->extras()->attach([$exSport->id, $exLed->id]);

        Car::create([
            'brand_id' => $brandFord->id, 
            'user_id' => null, 
            'model' => 'Mustang GT', 
            'type' => 'Gasolina', 
            'description' => 'Motor V8 5.0L atmosférico. Sonido puro.', 
            'price' => 58000.00,
            'image' => 'assets/img/ford/mustang.png'
        ])->extras()->attach([$exCuero->id, $exSport->id]);

        Car::create([
            'brand_id' => $brandBMW->id, 
            'user_id' => null, 
            'model' => 'M2 Coupé', 
            'type' => 'Gasolina', 
            'description' => 'Tracción trasera y mucha diversión.', 
            'price' => 78000.00,
            'image' => 'assets/img/bmw/m2.png'
        ])->extras()->attach([$exSport->id, $exAudio->id]);

        Car::create([
            'brand_id' => $brandToyota->id, 
            'user_id' => null, 
            'model' => 'GR Supra', 
            'type' => 'Gasolina', 
            'description' => 'Leyenda japonesa renacida.', 
            'price' => 65000.00,
            'image' => 'assets/img/toyota/supra-mk5.jpg'
        ]);

        Car::create([
            'brand_id' => $brandPorsche->id, 
            'user_id' => null, 
            'model' => '718 Cayman', 
            'type' => 'Gasolina', 
            'description' => 'Motor central. Equilibrio perfecto.', 
            'price' => 72000.00,
            'image' => 'assets/img/porshe/cayman.png'
        ])->extras()->attach([$exCuero->id]);

        Car::create([
            'brand_id' => $brandMercedes->id, 
            'user_id' => null, 
            'model' => 'Clase C Estate', 
            'type' => 'Diesel', 
            'description' => 'Viajes largos con la máxima comodidad.', 
            'price' => 52000.00,
            'image' => 'assets/img/mercedes/clasec.png'
        ])->extras()->attach([$exGPS->id, $exAudio->id]);

        Car::create([
            'brand_id' => $brandBMW->id, 
            'user_id' => null, 
            'model' => 'X3 xDrive', 
            'type' => 'Híbrido', 
            'description' => 'SUV premium con tracción total.', 
            'price' => 61000.00,
            'image' => 'assets/img/bmw/x3.png'
        ])->extras()->attach([$exTecho->id, $exLed->id]);
        
        Car::create([
            'brand_id' => $brandAudi->id, 
            'user_id' => null, 
            'model' => 'RS6 Avant', 
            'type' => 'Gasolina', 
            'description' => '600 CV para llevar la compra.', 
            'price' => 145000.00,
            'image' => 'assets/img/audi/rs6.png'
        ]);
        
        Car::create([
            'brand_id' => $brandPorsche->id, 
            'user_id' => null, 
            'model' => '911 Carrera', 
            'type' => 'Gasolina', 
            'description' => 'El 911 de acceso, atemporal.', 
            'price' => 130000.00,
            'image' => 'assets/img/porshe/911.png'
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