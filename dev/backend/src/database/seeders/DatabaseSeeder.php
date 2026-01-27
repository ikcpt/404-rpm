<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Brand;
use App\Models\Extra;
use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
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

        $brandFord = Brand::create(['name' => 'Ford', 'country' => 'Estados Unidos']);
        $brandAudi = Brand::create(['name' => 'Audi', 'country' => 'Alemania']);
        $brandPorsche = Brand::create(['name' => 'Porsche', 'country' => 'Alemania']);
        $brandFerrari = Brand::create(['name' => 'Ferrari', 'country' => 'Italia']);
        $brandBMW = Brand::create(['name' => 'BMW', 'country' => 'Alemania']);
        $brandMercedes = Brand::create(['name' => 'Mercedes-Benz', 'country' => 'Alemania']);
        $brandVW = Brand::create(['name' => 'Volkswagen', 'country' => 'Alemania']);
        $brandSeat = Brand::create(['name' => 'Seat', 'country' => 'España']);
        $brandToyota = Brand::create(['name' => 'Toyota', 'country' => 'Japón']);

        $exGPS = Extra::create(['name' => 'Navegador', 'description' => 'Pantalla con mapas.']);
        $exTecho = Extra::create(['name' => 'Techo Solar', 'description' => 'Techo abatible.']);
        $exCuero = Extra::create(['name' => 'Cuero', 'description' => 'Asientos de piel.']);
        $exSport = Extra::create(['name' => 'Pack Sport', 'description' => 'Suspensiones y escape deportivo.']);
        $exAudio = Extra::create(['name' => 'Audio Premium', 'description' => 'Sistema de sonido envolvente.']);
        $exLed = Extra::create(['name' => 'Faros LED Matrix', 'description' => 'Iluminación inteligente.']);

        $cars = [
            [
                'brand_id' => $brandFerrari->id,
                'model' => 'SF90 Stradale',
                'type' => 'Híbrido',
                'price' => 550000,
                'image' => 'assets/img/ferrari/sf90.png',
                'technical_sheet' => [
                    'engine' => ['power' => '1000 CV', 'configuration' => 'V8 biturbo + eléctricos', 'torque' => '800 Nm'],
                    'performance' => ['0_100' => '2.5s', 'top_speed' => '340 km/h'],
                    'transmission' => ['type' => 'DCT', 'drive' => 'AWD', 'gears' => 8],
                    'consumption' => ['combined' => '6.1 l/100km', 'emissions' => '154 g/km', 'eco' => 'CERO'],
                    'dimensions' => ['length' => '4710 mm', 'weight' => '1570 kg'],
                    'chassis' => ['suspension' => 'Adaptativa', 'brakes' => 'Carbono-cerámicos'],
                    'interior' => ['seats' => 'Deportivos', 'screens' => '16" digital'],
                    'safety' => ['adas' => true, 'airbags' => 6]
                ]
            ],
            [
                'brand_id' => $brandBMW->id,
                'model' => 'M4 Competition',
                'type' => 'Gasolina',
                'price' => 115000,
                'image' => 'assets/img/bmw/m4-competition.png',
                'technical_sheet' => [
                    'engine' => ['power' => '510 CV', 'configuration' => 'L6 biturbo', 'torque' => '650 Nm'],
                    'performance' => ['0_100' => '3.9s', 'top_speed' => '290 km/h'],
                    'transmission' => ['type' => 'Automática', 'drive' => 'RWD', 'gears' => 8],
                    'consumption' => ['combined' => '9.8 l/100km', 'eco' => 'C'],
                    'dimensions' => ['length' => '4794 mm', 'weight' => '1725 kg'],
                    'chassis' => ['suspension' => 'M adaptativa', 'brakes' => 'M Performance'],
                    'interior' => ['seats' => 'Bucket M', 'screens' => 'Curva 14"'],
                    'safety' => ['adas' => true, 'airbags' => 6]
                ]
            ],
            [
                'brand_id' => $brandToyota->id,
                'model' => 'Corolla Hybrid',
                'type' => 'Híbrido',
                'price' => 24000,
                'image' => 'assets/img/toyota/corolla.png',
                'technical_sheet' => [
                    'engine' => ['power' => '140 CV', 'configuration' => 'L4 híbrido', 'torque' => '185 Nm'],
                    'performance' => ['0_100' => '9.2s', 'top_speed' => '180 km/h'],
                    'transmission' => ['type' => 'e-CVT', 'drive' => 'FWD'],
                    'consumption' => ['combined' => '3.7 l/100km', 'eco' => 'ECO'],
                    'dimensions' => ['length' => '4370 mm', 'weight' => '1375 kg'],
                    'chassis' => ['suspension' => 'Confort', 'brakes' => 'Disco'],
                    'interior' => ['screens' => '10.5"', 'connectivity' => 'Apple/Android'],
                    'safety' => ['adas' => true, 'airbags' => 7]
                ]
            ]
        ];

        foreach ($cars as $data) {
            Car::create(array_merge($data, [
                'user_id' => null,
                'description' => 'Vehículo con ficha técnica extendida y equipamiento completo.'
            ]));
        }

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