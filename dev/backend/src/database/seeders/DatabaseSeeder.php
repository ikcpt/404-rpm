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
        // --- FUNCIÓN AUXILIAR PARA CALCULAR LA CLASE ---
        $getClase = function ($price) {
            if ($price > 150000) return 'Gama Alta';
            elseif ($price >= 50000) return 'Gama Media';
            else return 'Ocasión';
        };

        // 1. USUARIOS
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

        // 2. MARCAS
        
        $brandLamborghini = Brand::create(['name' => 'Lamborghini', 'country' => 'Italia', 'image' => 'assets/img/lamborguini/logo-lambo.png']);
        $brandFerrari = Brand::create(['name' => 'Ferrari', 'country' => 'Italia', 'image' => 'assets/img/ferrari/logo-ferrari.png']);
        $brandPorsche = Brand::create(['name' => 'Porsche', 'country' => 'Alemania', 'image' => 'assets/img/porsche/logo-porsche.png']);
        $brandAudi = Brand::create(['name' => 'Audi', 'country' => 'Alemania', 'image' => 'assets/img/audi/logo-audi.png']);
        $brandBMW = Brand::create(['name' => 'BMW', 'country' => 'Alemania', 'image' => 'assets/img/bmw/logo-bmw.png']);
        $brandMercedes = Brand::create(['name' => 'Mercedes-Benz', 'country' => 'Alemania', 'image' => 'assets/img/mercedes/logo-mercedes.png']);
        $brandFord = Brand::create(['name' => 'Ford', 'country' => 'Estados Unidos', 'image' => 'assets/img/ford/logo-ford.png']);
        $brandToyota = Brand::create(['name' => 'Toyota', 'country' => 'Japón', 'image' => 'assets/img/toyota/logo-toyota.png']);
        $brandVW = Brand::create(['name' => 'Volkswagen', 'country' => 'Alemania', 'image' => 'assets/img/vw/logo-vw.png']);
        $brandSeat = Brand::create(['name' => 'Seat', 'country' => 'Alemania', 'image' => 'assets/img/seat/logo-seat.png']);
        $brandMini = Brand::create(['name' => 'Mini', 'country' => 'Alemania', 'image' => 'assets/img/mini/logo-mini.png']);

        // 3. EXTRAS
        $exGPS = Extra::create(['name' => 'Navegador', 'description' => 'Pantalla con mapas.']);
        $exTecho = Extra::create(['name' => 'Techo Solar', 'description' => 'Techo abatible.']);
        $exCuero = Extra::create(['name' => 'Cuero', 'description' => 'Asientos de piel.']);
        $exSport = Extra::create(['name' => 'Pack Sport', 'description' => 'Suspensiones y escape deportivo.']);
        $exAudio = Extra::create(['name' => 'Audio Premium', 'description' => 'Sistema de sonido envolvente.']);
        $exLed = Extra::create(['name' => 'Faros LED Matrix', 'description' => 'Iluminación inteligente.']);

        
        // ============================================
        //  COCHES
        // ============================================

        $price = 285000.00; // ALTA
        $car = Car::create([
            'brand_id' => $brandFerrari->id, 'user_id' => $userCarlos->id, 'model' => 'F8 Tributo', 
            'color' => 'Rojo Rosso Corsa',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2021, 'km' => 3500, 'engine_size' => '3.9L V8 Twin-Turbo',
            'hp' => 720, 'torque' => 770, 'weight' => 1435,
            'description' => 'Deportivo de alto rendimiento con motor V8.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ferrari/f8-tributo.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exSport->id, $exLed->id, $exAudio->id]);

        $price = 240000.00; // ALTA
        $car = Car::create([
            'brand_id' => $brandLamborghini->id, 'user_id' => $userLaura->id, 'model' => 'Huracán', 
            'color' => 'Negro Mate',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2022, 'km' => 2100, 'engine_size' => '5.2L V10',
            'hp' => 640, 'torque' => 600, 'weight' => 1422,
            'description' => 'Superdeportivo italiano con motor V10.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/lamborguini/huracan.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exSport->id, $exLed->id]);

        $price = 145000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandAudi->id, 'user_id' => $userDavid->id, 'model' => 'R8 V10', 
            'color' => 'Gris Anthracita',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2020, 'km' => 15000, 'engine_size' => '5.2L V10 FSI',
            'hp' => 620, 'torque' => 580, 'weight' => 1595,
            'description' => 'Coupé deportivo con motor V10.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/audi/r8.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exAudio->id]);

        $price = 92000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandBMW->id, 'user_id' => null, 'model' => 'M4 Competition', 
            'color' => 'Gris Anthracita',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2021, 'km' => 12000, 'engine_size' => '3.0L L6 Twin-Turbo',
            'hp' => 510, 'torque' => 650, 'weight' => 1725,
            'description' => 'Coupé deportivo con motor S58, 510 CV.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/bmw/m4-competition.png'
        ]);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 85000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandMercedes->id, 'user_id' => null, 'model' => 'C63 AMG', 
            'color' => 'Negro Mate',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2019, 'km' => 35000, 'engine_size' => '4.0L V8 Biturbo',
            'hp' => 510, 'torque' => 700, 'weight' => 1680,
            'description' => 'Deportivo alemán con motor V8.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mercedes/c63-amg.png'
        ]);
        $car->extras()->attach([$exCuero->id, $exAudio->id, $exTecho->id]);

        $price = 68000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandAudi->id, 'user_id' => null, 'model' => 'RS3 Avant', 
            'color' => 'Verde',
            'type' => 'Familiar', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2022, 'km' => 8500, 'engine_size' => '2.5L L5 TFSI',
            'hp' => 400, 'torque' => 500, 'weight' => 1570,
            'description' => 'Familiar deportivo con motor turbo, 400 CV.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/audi/rs3-avant.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exLed->id]);

        $price = 22500.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandVW->id, 'user_id' => null, 'model' => 'Golf GTI', 
            'color' => 'Gris Anthracita',
            'type' => 'Compacto', 'fuel' => 'Gasolina', 'transmission' => 'Manual', 'year' => 2018, 'km' => 65000, 'engine_size' => '2.0L TSI',
            'hp' => 245, 'torque' => 370, 'weight' => 1390,
            'description' => 'Hatchback deportivo clásico.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/VW/gti.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exTecho->id]);

        $price = 18900.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandMini->id, 'user_id' => null, 'model' => 'Mini Cooper S', 
            'color' => 'British Racing Green',
            'type' => 'Compacto', 'fuel' => 'Gasolina', 'transmission' => 'Manual', 'year' => 2019, 'km' => 42000, 'engine_size' => '2.0L Turbo',
            'hp' => 178, 'torque' => 280, 'weight' => 1290,
            'description' => 'Clásico urbano con motor turbo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mini/mini-chope.png'
        ]);
        $car->extras()->attach([$exTecho->id, $exAudio->id]);

        $price = 20000.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandSeat->id, 'user_id' => null, 'model' => 'Leon', 
            'color' => 'Rojo Emoción',
            'type' => 'Compacto', 'fuel' => 'Gasolina', 'transmission' => 'Manual', 'year' => 2020, 'km' => 28000, 'engine_size' => '1.5L TSI',
            'hp' => 150, 'torque' => 250, 'weight' => 1300,
            'description' => 'Compacto español, diseño moderno.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/seat/seta-leon.png'
        ]);
        $car->extras()->attach([$exGPS->id]);

        $price = 61828.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandFord->id, 'user_id' => null, 'model' => 'Mustang GT', 
            'color' => 'Rojo Velocity',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Manual', 'year' => 2021, 'km' => 15000, 'engine_size' => '5.0L V8 Coyote',
            'hp' => 450, 'torque' => 529, 'weight' => 1740,
            'description' => 'El pony car por excelencia.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ford/mustang-GT.png'
        ]);
        $car->extras()->attach([$exSport->id, $exAudio->id]);

        $price = 140000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandPorsche->id, 'user_id' => null, 'model' => '911 Carrera', 
            'color' => 'Blanco Polar',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2022, 'km' => 5000, 'engine_size' => '3.0L Boxer-6 Twin-Turbo',
            'hp' => 385, 'torque' => 450, 'weight' => 1505,
            'description' => 'La leyenda de Stuttgart.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/porsche/911.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exSport->id]);

        $price = 69000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandToyota->id, 'user_id' => null, 'model' => 'GR Supra', 
            'color' => 'Gris Tormenta',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2020, 'km' => 18000, 'engine_size' => '3.0L L6 Turbo',
            'hp' => 340, 'torque' => 500, 'weight' => 1495,
            'description' => 'El retorno del mito japonés.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/toyota/supra.png'
        ]);
        $car->extras()->attach([$exSport->id]);

        $price = 105300.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandBMW->id, 'user_id' => null, 'model' => 'X5 xDrive', 
            'color' => 'Negro Forestal',
            'type' => 'SUV', 'fuel' => 'Híbrido', 'transmission' => 'Automática', 'year' => 2021, 'km' => 25000, 'engine_size' => '3.0L L6 + Eléctrico',
            'hp' => 394, 'torque' => 600, 'weight' => 2510,
            'description' => 'SUV de lujo híbrido.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/bmw/x5-xDrive.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exCuero->id]);

        $price = 38000.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandMercedes->id, 'user_id' => null, 'model' => 'Clase A', 
            'color' => 'Negro Perlado',
            'type' => 'Compacto', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2019, 'km' => 45000, 'engine_size' => '1.3L Turbo',
            'hp' => 163, 'torque' => 250, 'weight' => 1375,
            'description' => 'El compacto premium.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mercedes/clase-a.png'
        ]);
        $car->extras()->attach([$exLed->id]);

        $price = 67552.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandMercedes->id, 'user_id' => null, 'model' => 'AMG A45 S', 
            'color' => 'Blanco Perlado',
            'type' => 'Compacto', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2021, 'km' => 12000, 'engine_size' => '2.0L Turbo',
            'hp' => 421, 'torque' => 500, 'weight' => 1635,
            'description' => 'El compacto más potente del mundo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mercedes/mercedes-amg-A45.png'
        ]);
        $car->extras()->attach([$exLed->id, $exSport->id]);

        $price = 265000.00; // ALTA
        $car = Car::create([
            'brand_id' => $brandLamborghini->id, 'user_id' => null, 'model' => 'Urus', 
            'color' => 'Gris Monocerus',
            'type' => 'SUV', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2022, 'km' => 9000, 'engine_size' => '4.0L V8 Twin-Turbo',
            'hp' => 650, 'torque' => 850, 'weight' => 2200,
            'description' => 'El Super SUV más rápido y versátil del mundo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/lamborguini/urus.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exSport->id, $exAudio->id, $exTecho->id]);

        $price = 38500.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandToyota->id, 'user_id' => null, 'model' => 'Yaris GR', 
            'color' => 'NeGRo Carbon',
            'type' => 'Compacto', 'fuel' => 'Gasolina', 'transmission' => 'Manual', 'year' => 2021, 'km' => 8000, 'engine_size' => '1.6L L3 Turbo',
            'hp' => 261, 'torque' => 360, 'weight' => 1280,
            'description' => 'Nacido del WRC. Pequeño, tracción total y muy divertido.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/toyota/yaris-gr.png'
        ]);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 74000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandPorsche->id, 'user_id' => null, 'model' => '718 Cayman', 
            'color' => 'Blanco Artico',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2020, 'km' => 16000, 'engine_size' => '2.0L Boxer-4 Turbo',
            'hp' => 300, 'torque' => 380, 'weight' => 1365,
            'description' => 'Motor central y equilibrio perfecto para curvas.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/porsche/cayman.png'
        ]);
        $car->extras()->attach([$exSport->id, $exAudio->id]);

        $price = 106000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandAudi->id, 'user_id' => null, 'model' => 'e-tron GT', 
            'color' => 'Rojo Daytona',
            'type' => 'Berlina', 'fuel' => 'Eléctrico', 'transmission' => 'Automática', 'year' => 2022, 'km' => 5000, 'engine_size' => 'Eléctrico Dual Motor',
            'hp' => 530, 'torque' => 640, 'weight' => 2350,
            'description' => 'El futuro es eléctrico. Diseño futurista y aceleración instantánea.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/audi/etron-gt.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exLed->id, $exTecho->id]);

        $price = 58000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandFord->id, 'user_id' => null, 'model' => 'Ranger Raptor', 
            'color' => 'Azul Performance',
            'type' => 'Pick-up', 'fuel' => 'Diésel', 'transmission' => 'Automática', 'year' => 2021, 'km' => 30000, 'engine_size' => '2.0L EcoBlue Bi-Turbo',
            'hp' => 213, 'torque' => 500, 'weight' => 2500,
            'description' => 'Pick-up preparada para saltar dunas y terreno difícil.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ford/ranger-raptor.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exSport->id]);

        $price = 56000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandBMW->id, 'user_id' => null, 'model' => 'Z4 Roadster', 
            'color' => 'Gris San Francisco',
            'type' => 'Cabrio', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2020, 'km' => 14000, 'engine_size' => '2.0L Turbo',
            'hp' => 197, 'torque' => 320, 'weight' => 1495,
            'description' => 'Descapotable biplaza para disfrutar del cielo abierto.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/bmw/z4.png'
        ]);
        $car->extras()->attach([$exTecho->id, $exAudio->id]);

        $price = 95000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandMercedes->id, 'user_id' => null, 'model' => 'GLE Coupé', 
            'color' => 'Azul Mar Profundo',
            'type' => 'SUV', 'fuel' => 'Híbrido', 'transmission' => 'Automática', 'year' => 2021, 'km' => 22000, 'engine_size' => '2.0L Diésel + Eléctrico',
            'hp' => 330, 'torque' => 700, 'weight' => 2300,
            'description' => 'SUV elegante con silueta coupé y gran confort.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mercedes/gle-coupe.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exLed->id]);

        $price = 225000.00; // ALTA
        $car = Car::create([
            'brand_id' => $brandFerrari->id, 'user_id' => null, 'model' => 'Roma', 
            'color' => 'Rojo Rosso Corsa',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2022, 'km' => 3000, 'engine_size' => '3.9L V8 Twin-Turbo',
            'hp' => 620, 'torque' => 760, 'weight' => 1570,
            'description' => 'La Dolce Vita. Un GT elegante con motor V8 turbo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ferrari/roma.png'
        ]);
        $car->extras()->attach([$exCuero->id, $exGPS->id, $exAudio->id]);

        $price = 65000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandVW->id, 'user_id' => null, 'model' => 'Tiguan R', 
            'color' => 'Azul Lapiz',
            'type' => 'SUV', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2021, 'km' => 18000, 'engine_size' => '2.0L TSI',
            'hp' => 320, 'torque' => 420, 'weight' => 1746,
            'description' => 'SUV familiar pero con 320 CV y escape Akrapovic.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/VW/tiguan-r.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exSport->id, $exTecho->id]);

        $price = 19500.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandSeat->id, 'user_id' => null, 'model' => 'Ibiza FR', 
            'color' => 'Rojo Pasión',
            'type' => 'Compacto', 'fuel' => 'Gasolina', 'transmission' => 'Manual', 'year' => 2019, 'km' => 38000, 'engine_size' => '1.0L TSI',
            'hp' => 110, 'torque' => 200, 'weight' => 1160,
            'description' => 'El utilitario joven y dinámico. Ideal para ciudad.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/seat/ibiza-fr.png'
        ]);
        $car->extras()->attach([$exLed->id, $exAudio->id]);

        $price = 41000.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandMini->id, 'user_id' => null, 'model' => 'Countryman', 
            'color' => 'Verde Moonwalk',
            'type' => 'SUV', 'fuel' => 'Híbrido', 'transmission' => 'Automática', 'year' => 2020, 'km' => 26000, 'engine_size' => '1.5L Turbo + Eléctrico',
            'hp' => 220, 'torque' => 385, 'weight' => 1790,
            'description' => 'El Mini más grande y aventurero, ahora híbrido.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mini/countryman.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exTecho->id]);

        $price = 39500.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandToyota->id, 'user_id' => null, 'model' => 'RAV4', 
            'color' => 'Negro Luna',
            'type' => 'SUV', 'fuel' => 'Híbrido', 'transmission' => 'Automática', 'year' => 2019, 'km' => 55000, 'engine_size' => '2.5L Híbrido',
            'hp' => 222, 'torque' => 221, 'weight' => 1680,
            'description' => 'El SUV híbrido más fiable y vendido.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/toyota/rav4.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exLed->id]);

        $price = 115000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandPorsche->id, 'user_id' => null, 'model' => 'Panamera', 
            'color' => 'Rojo Jet',
            'type' => 'Berlina', 'fuel' => 'Híbrido', 'transmission' => 'Automática', 'year' => 2021, 'km' => 28000, 'engine_size' => '2.9L V6 + Eléctrico',
            'hp' => 462, 'torque' => 700, 'weight' => 2200,
            'description' => 'Berlina de lujo con prestaciones de deportivo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/porsche/panamera.png'
        ]);
        $car->extras()->attach([$exCuero->id, $exAudio->id, $exGPS->id, $exTecho->id]);

        $price = 36000.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandFord->id, 'user_id' => null, 'model' => 'Focus ST', 
            'color' => 'Naranja Furia',
            'type' => 'Compacto', 'fuel' => 'Gasolina', 'transmission' => 'Manual', 'year' => 2020, 'km' => 32000, 'engine_size' => '2.3L EcoBoost',
            'hp' => 280, 'torque' => 420, 'weight' => 1512,
            'description' => 'Compacto deportivo, divertido y manual.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ford/focus-st.png'
        ]);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 88000.00; // MEDIA
        $car = Car::create([
            'brand_id' => $brandAudi->id, 'user_id' => null, 'model' => 'Q8 S-Line', 
            'color' => 'Beige Glaciar',
            'type' => 'SUV', 'fuel' => 'Diésel', 'transmission' => 'Automática', 'year' => 2021, 'km' => 24000, 'engine_size' => '3.0L TDI V6',
            'hp' => 286, 'torque' => 600, 'weight' => 2220,
            'description' => 'El buque insignia de los SUV de Audi. Imponente.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/audi/q8.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exAudio->id, $exTecho->id]);


        // ============================================
        //  REFUERZOS
        // ============================================

        $price = 450000.00; // ALTA
        $car = Car::create([
            'brand_id' => $brandLamborghini->id, 'user_id' => null, 'model' => 'Aventador SVJ', 
            'color' => 'Gris Viola Parsifae',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2021, 'km' => 4500, 'engine_size' => '6.5L V12',
            'hp' => 770, 'torque' => 720, 'weight' => 1525,
            'description' => 'V12 atmosférico, puertas de tijera y sonido celestial.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/lamborguini/aventador.png'
        ]);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 230000.00; // ALTA
        $car = Car::create([
            'brand_id' => $brandPorsche->id, 'user_id' => null, 'model' => '911 Turbo S', 
            'color' => 'Amarillo Cartagena Metalizado',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2022, 'km' => 6000, 'engine_size' => '3.8L Boxer-6 Twin-Turbo',
            'hp' => 650, 'torque' => 800, 'weight' => 1640,
            'description' => 'El rey de la aceleración. 0 a 100 en 2.7 segundos.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/porsche/911-turbo.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exSport->id, $exAudio->id]);

        $price = 550000.00; // ALTA
        $car = Car::create([
            'brand_id' => $brandFord->id, 'user_id' => null, 'model' => 'Ford GT', 
            'color' => 'Azul Líquido',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2020, 'km' => 1200, 'engine_size' => '3.5L V6 EcoBoost',
            'hp' => 660, 'torque' => 746, 'weight' => 1385,
            'description' => 'Un coche de carreras con matrícula. Fibra de carbono pura.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ford/ford-gt.png'
        ]);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 340000.00; // ALTA
        $car = Car::create([
            'brand_id' => $brandFerrari->id, 'user_id' => null, 'model' => '812 Superfast', 
            'color' => 'Amarillo Modena Carrera',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2021, 'km' => 5800, 'engine_size' => '6.5L V12',
            'hp' => 800, 'torque' => 718, 'weight' => 1630,
            'description' => 'El GT con motor delantero más potente de la historia.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ferrari/812.png'
        ]);
        $car->extras()->attach([$exCuero->id, $exGPS->id, $exAudio->id]);

        $price = 360000.00; // ALTA
        $car = Car::create([
            'brand_id' => $brandMercedes->id, 'user_id' => null, 'model' => 'AMG GT Black Series', 
            'color' => 'Naranja Magma',
            'type' => 'Coupé', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2021, 'km' => 2000, 'engine_size' => '4.0L V8 Biturbo Flat-Plane',
            'hp' => 730, 'torque' => 800, 'weight' => 1540,
            'description' => 'Récord en Nürburgring. Aerodinámica activa extrema.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mercedes/amg-gt-black.png'
        ]);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 180000.00; // ALTA
        $car = Car::create([
            'brand_id' => $brandAudi->id, 'user_id' => null, 'model' => 'R8 Spyder V10', 
            'color' => 'Negro Ara',
            'type' => 'Cabrio', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2020, 'km' => 9500, 'engine_size' => '5.2L V10 FSI',
            'hp' => 570, 'torque' => 560, 'weight' => 1695,
            'description' => 'Descapotable con motor V10 atmosférico.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/audi/r8-spyder.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exAudio->id]);


        // --- REFUERZOS OCASIÓN ---

        $price = 32000.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandVW->id, 'user_id' => null, 'model' => 'Polo GTI', 
            'color' => 'Blanco Flash',
            'type' => 'Compacto', 'fuel' => 'Gasolina', 'transmission' => 'Automática', 'year' => 2020, 'km' => 27000, 'engine_size' => '2.0L TSI',
            'hp' => 207, 'torque' => 320, 'weight' => 1286,
            'description' => 'El hermano pequeño del Golf. Ágil y divertido.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/VW/polo-gti.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exSport->id]);

        $price = 29000.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandToyota->id, 'user_id' => null, 'model' => 'Corolla GR Sport', 
            'color' => 'Rojo Ascari',
            'type' => 'Compacto', 'fuel' => 'Híbrido', 'transmission' => 'Automática', 'year' => 2021, 'km' => 19000, 'engine_size' => '2.0L Híbrido',
            'hp' => 184, 'torque' => 190, 'weight' => 1370,
            'description' => 'Compacto híbrido con estética deportiva.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/toyota/corolla-gr.png'
        ]);
        $car->extras()->attach([$exGPS->id, $exLed->id]);

        $price = 34000.00; // OCASIÓN
        $car = Car::create([
            'brand_id' => $brandFord->id, 'user_id' => null, 'model' => 'Puma ST', 
            'color' => 'Azul Mean',
            'type' => 'SUV', 'fuel' => 'Gasolina', 'transmission' => 'Manual', 'year' => 2021, 'km' => 15000, 'engine_size' => '1.5L EcoBoost',
            'hp' => 200, 'torque' => 320, 'weight' => 1358,
            'description' => 'SUV pequeño con alma de deportivo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ford/puma-st.png'
        ]);
        $car->extras()->attach([$exSport->id, $exAudio->id]);


        // 5. REVIEWS
        $reviews = [
            ['rating' => 5, 'content' => 'Excelente servicio.'],
            ['rating' => 4, 'content' => 'Buen trato, algo lentos.'],
            ['rating' => 3, 'content' => 'Correcto sin más.'],
            ['rating' => 5, 'content' => 'Grandes profesionales.'],
            ['rating' => 5, 'content' => 'El coche está impecable.'],
            ['rating' => 4, 'content' => 'Muy contento con la compra.'],
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