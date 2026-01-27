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
       // ----------------------------------------------------------------------
        // COCHES
        // ----------------------------------------------------------------------

        // === FERRARI ===
        $car = Car::create([
            'brand_id' => $brandFerrari->id, 
            'user_id' => $userCarlos->id, 
            'model' => 'SF90 Stradale', 
            'type' => 'Híbrido', 
            'description' => 'Superdeportivo híbrido enchufable de 1000 CV. Aceleración de 0 a 100 en 2.5s.', 
            'price' => 550000.00,
            'image' => 'assets/img/ferrari/sf90.png'
        ]);
        $car->extras()->attach([$exCuero->id, $exSport->id, $exCeramicos->id ?? $exSport->id]); // Fallback si no tienes ceramicos

        $car = Car::create([
            'brand_id' => $brandFerrari->id,
            'user_id' => null,
            'model' => 'Roma',
            'type' => 'Gasolina',
            'description' => 'La Dolce Vita moderna. Un GT elegante con motor V8 turbo.',
            'price' => 220000.00,
            'image' => 'assets/img/ferrari/roma.png'
        ]);
        $car->extras()->attach([$exCuero->id, $exGPS->id]);

        // === BMW ===
        $car = Car::create([
            'brand_id' => $brandBMW->id, 
            'user_id' => $userLaura->id, 
            'model' => 'M4 Competition', 
            'type' => 'Gasolina', 
            'description' => 'Coupé deportivo de alto rendimiento. Riñones frontales distintivos y 510 CV.', 
            'price' => 115000.00,
            'image' => 'assets/img/bmw/m4-competition.png'
        ]);
        $car->extras()->attach([$exSport->id, $exGPS->id, $exCarbono->id ?? $exSport->id]);

        Car::create([
            'brand_id' => $brandBMW->id, 
            'user_id' => null, 
            'model' => 'M2 Coupé', 
            'type' => 'Gasolina', 
            'description' => 'Pura conducción. Tracción trasera, compacto y muy ágil en curvas.', 
            'price' => 78000.00,
            'image' => 'assets/img/bmw/m2.png'
        ])->extras()->attach([$exSport->id, $exAudio->id]);

        Car::create([
            'brand_id' => $brandBMW->id, 
            'user_id' => null, 
            'model' => 'X3 xDrive', 
            'type' => 'Híbrido', 
            'description' => 'SUV premium versátil con tracción total inteligente y etiqueta ECO.', 
            'price' => 61000.00,
            'image' => 'assets/img/bmw/x3.png'
        ])->extras()->attach([$exTecho->id, $exLed->id]);

        Car::create([
            'brand_id' => $brandBMW->id,
            'user_id' => null,
            'model' => 'Serie 1',
            'type' => 'Diesel',
            'description' => 'Compacto premium, ideal para el día a día con bajo consumo.',
            'price' => 34000.00,
            'image' => 'assets/img/bmw/serie1.png'
        ])->extras()->attach([$exGPS->id]);

        // === AUDI ===
        $car = Car::create([
            'brand_id' => $brandAudi->id, 
            'user_id' => $userDavid->id, 
            'model' => 'Q7 TDI', 
            'type' => 'Diesel', 
            'description' => 'El SUV familiar definitivo. 7 plazas reales y confort de marcha insuperable.', 
            'price' => 85000.00,
            'image' => 'assets/img/audi/q7.png'
        ]);
        $car->extras()->attach([$exTecho->id, $exAudio->id, $exCam360->id ?? $exGPS->id]);

        Car::create([
            'brand_id' => $brandAudi->id, 
            'user_id' => null, 
            'model' => 'A3 Sportback', 
            'type' => 'Diesel', 
            'description' => 'Acabado S-Line. Tecnología avanzada en formato compacto.', 
            'price' => 34500.00,
            'image' => 'assets/img/audi/a3.png'
        ])->extras()->attach([$exGPS->id, $exTecho->id]);

        Car::create([
            'brand_id' => $brandAudi->id, 
            'user_id' => null, 
            'model' => 'RS6 Avant', 
            'type' => 'Gasolina', 
            'description' => 'El familiar más rápido del mundo. 600 CV con maletero para todo.', 
            'price' => 145000.00,
            'image' => 'assets/img/audi/rs6.png'
        ])->extras()->attach([$exSport->id, $exAudio->id, $exCuero->id]);

        Car::create([
            'brand_id' => $brandAudi->id,
            'user_id' => null,
            'model' => 'e-tron GT',
            'type' => 'Eléctrico',
            'description' => 'El futuro es hoy. Gran Turismo eléctrico de diseño escultural.',
            'price' => 105000.00,
            'image' => 'assets/img/audi/etron.png'
        ])->extras()->attach([$exLed->id, $exGPS->id]);


        // === TOYOTA ===
        $car = Car::create([
            'brand_id' => $brandToyota->id, 
            'user_id' => $userJuan->id, 
            'model' => 'Corolla', 
            'type' => 'Híbrido', 
            'description' => 'El coche más vendido del mundo. Fiabilidad y eficiencia japonesa.', 
            'price' => 24000.00,
            'image' => 'assets/img/toyota/corolla.png'
        ]);

        Car::create([
            'brand_id' => $brandToyota->id, 
            'user_id' => null, 
            'model' => 'Yaris Hybrid', 
            'type' => 'Híbrido', 
            'description' => 'El rey de la ciudad. Fácil de aparcar y consumo ridículo.', 
            'price' => 21000.00,
            'image' => 'assets/img/toyota/yaris.jpg'
        ]);

        Car::create([
            'brand_id' => $brandToyota->id, 
            'user_id' => null, 
            'model' => 'GR Supra', 
            'type' => 'Gasolina', 
            'description' => 'Leyenda japonesa renacida. Motor de 6 cilindros y pura emoción.', 
            'price' => 65000.00,
            'image' => 'assets/img/toyota/supra-mk5.jpg'
        ])->extras()->attach([$exSport->id]);

        Car::create([
            'brand_id' => $brandToyota->id,
            'user_id' => null,
            'model' => 'RAV4',
            'type' => 'Híbrido',
            'description' => 'El SUV híbrido por excelencia. Espacioso y robusto.',
            'price' => 38000.00,
            'image' => 'assets/img/toyota/rav4.png'
        ])->extras()->attach([$exGPS->id]);


        // === SEAT ===
        Car::create([
            'brand_id' => $brandSeat->id, 
            'user_id' => null, 
            'model' => 'Ibiza FR', 
            'type' => 'Gasolina', 
            'description' => 'Dinámico y juvenil. Acabado deportivo FR con llantas de aleación.', 
            'price' => 18500.00,
            'image' => 'assets/img/seat/ibiza.png'
        ])->extras()->attach([$exLed->id]);

        Car::create([
            'brand_id' => $brandSeat->id,
            'user_id' => null,
            'model' => 'Ateca',
            'type' => 'Diesel',
            'description' => 'Un SUV diseñado en Barcelona. Equilibrio perfecto precio-calidad.',
            'price' => 28000.00,
            'image' => 'assets/img/seat/ateca.png'
        ])->extras()->attach([$exGPS->id]);


        // === FORD ===
        Car::create([
            'brand_id' => $brandFord->id, 
            'user_id' => null, 
            'model' => 'Focus ST-Line', 
            'type' => 'Diesel', 
            'description' => 'Chasis afinado para disfrutar conduciendo. Muy bajo consumo en carretera.', 
            'price' => 22900.00,
            'image' => 'assets/img/ford/focus.jpg'
        ]);

        Car::create([
            'brand_id' => $brandFord->id, 
            'user_id' => null, 
            'model' => 'Mustang GT', 
            'type' => 'Gasolina', 
            'description' => 'El Muscle Car americano. Motor V8 5.0L atmosférico y sonido inconfundible.', 
            'price' => 58000.00,
            'image' => 'assets/img/ford/mustang.png'
        ])->extras()->attach([$exCuero->id, $exSport->id]);

        Car::create([
            'brand_id' => $brandFord->id,
            'user_id' => null,
            'model' => 'Kuga PHEV',
            'type' => 'Híbrido',
            'description' => 'SUV Híbrido enchufable. Lo mejor de los dos mundos.',
            'price' => 36000.00,
            'image' => 'assets/img/ford/kuga.png'
        ])->extras()->attach([$exTecho->id]);


        // === VOLKSWAGEN ===
        Car::create([
            'brand_id' => $brandVW->id, 
            'user_id' => null, 
            'model' => 'Polo GTI', 
            'type' => 'Gasolina', 
            'description' => 'Pequeño pero matón. 207 CV en un formato de bolsillo.', 
            'price' => 32000.00,
            'image' => 'assets/img/VW/polo.png'
        ])->extras()->attach([$exSport->id]);

        Car::create([
            'brand_id' => $brandVW->id, 
            'user_id' => null, 
            'model' => 'Golf GTI 8', 
            'type' => 'Gasolina', 
            'description' => 'El mito. El compacto deportivo que define la categoría desde hace décadas.', 
            'price' => 46000.00,
            'image' => 'assets/img/VW/golf.png'
        ])->extras()->attach([$exSport->id, $exLed->id]);

        Car::create([
            'brand_id' => $brandVW->id,
            'user_id' => null,
            'model' => 'Tiguan R-Line',
            'type' => 'Diesel',
            'description' => 'Tecnología alemana en formato SUV. Acabado deportivo R-Line.',
            'price' => 42000.00,
            'image' => 'assets/img/VW/tiguan.png'
        ])->extras()->attach([$exTecho->id, $exGPS->id]);


        // === PORSCHE ===
        Car::create([
            'brand_id' => $brandPorsche->id, 
            'user_id' => null, 
            'model' => '718 Cayman', 
            'type' => 'Gasolina', 
            'description' => 'Motor central para un equilibrio perfecto en curva. Pura ingeniería.', 
            'price' => 72000.00,
            'image' => 'assets/img/porshe/cayman.png'
        ])->extras()->attach([$exCuero->id]);

        Car::create([
            'brand_id' => $brandPorsche->id, 
            'user_id' => null, 
            'model' => '911 Carrera', 
            'type' => 'Gasolina', 
            'description' => 'El deportivo atemporal. Silueta icónica y prestaciones de infarto.', 
            'price' => 130000.00,
            'image' => 'assets/img/porshe/911.png'
        ])->extras()->attach([$exSport->id, $exCuero->id]);

        Car::create([
            'brand_id' => $brandPorsche->id,
            'user_id' => null,
            'model' => 'Macan',
            'type' => 'Gasolina',
            'description' => 'El SUV que se conduce como un deportivo.',
            'price' => 82000.00,
            'image' => 'assets/img/porshe/macan.png'
        ])->extras()->attach([$exGPS->id, $exAudio->id]);


        // === MERCEDES-BENZ ===
        Car::create([
            'brand_id' => $brandMercedes->id, 
            'user_id' => null, 
            'model' => 'Clase C Estate', 
            'type' => 'Diesel', 
            'description' => 'Viajes largos con la máxima comodidad y espacio de carga.', 
            'price' => 52000.00,
            'image' => 'assets/img/mercedes/clasec.png'
        ])->extras()->attach([$exGPS->id, $exAudio->id]);

        Car::create([
            'brand_id' => $brandMercedes->id,
            'user_id' => null,
            'model' => 'Clase G',
            'type' => 'Gasolina',
            'description' => 'El todoterreno icónico. Lujo extremo y capacidad off-road sin límites.',
            'price' => 180000.00,
            'image' => 'assets/img/mercedes/claseg.png'
        ])->extras()->attach([$exCuero->id, $exTecho->id, $exAudio->id]);

        Car::create([
            'brand_id' => $brandMercedes->id,
            'user_id' => null,
            'model' => 'AMG GT',
            'type' => 'Gasolina',
            'description' => 'Desarrollado por los ingenieros de carreras. V8 Biturbo.',
            'price' => 160000.00,
            'image' => 'assets/img/mercedes/amggt.png'
        ])->extras()->attach([$exSport->id, $exLed->id]);
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