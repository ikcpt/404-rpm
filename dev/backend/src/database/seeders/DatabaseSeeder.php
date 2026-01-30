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
            if ($price > 150000) {
                return 'Gama Alta';
            } elseif ($price >= 50000) {
                return 'Gama Media';
            } else {
                return 'Ocasión';
            }
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

        $userElena = User::create(['name' => 'Joan', 'email' => 'joan.new@email.com', 'password' => '1234']);
        Profile::create(['user_id' => $userElena->id, 'surname' => 'Vázquez', 'phone' => '633445566', 'address' => 'Barcelona']);

        $userJuan = User::create(['name' => 'Juan Pérez', 'email' => 'juan.perez@email.com', 'password' => '1234']);
        Profile::create(['user_id' => $userJuan->id, 'surname' => 'Pérez', 'phone' => '644556677', 'address' => 'Bilbao']);

        // 2. MARCAS
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
        $brandLamborghini = Brand::create(['name' => 'Lamborghini', 'country' => 'Italia']);

        // 3. EXTRAS
        $exGPS = Extra::create(['name' => 'Navegador', 'description' => 'Pantalla con mapas.']);
        $exTecho = Extra::create(['name' => 'Techo Solar', 'description' => 'Techo abatible.']);
        $exCuero = Extra::create(['name' => 'Cuero', 'description' => 'Asientos de piel.']);
        $exSport = Extra::create(['name' => 'Pack Sport', 'description' => 'Suspensiones y escape deportivo.']);
        $exAudio = Extra::create(['name' => 'Audio Premium', 'description' => 'Sistema de sonido envolvente.']);
        $exLed = Extra::create(['name' => 'Faros LED Matrix', 'description' => 'Iluminación inteligente.']);

        
        // ============================================
        //  COCHES EXISTENTES (Gama Alta: 4 | Media: 17 | Ocasión: 9)
        // ============================================

        $price = 285000.00; // ALTA
        $car = Car::create(['brand_id' => $brandFerrari->id, 'user_id' => $userCarlos->id, 'model' => 'F8 Tributo', 'type' => 'Gasolina', 'description' => 'Deportivo de alto rendimiento con motor V8.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ferrari/f8-tributo.png']);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exSport->id, $exLed->id, $exAudio->id]);

        $price = 240000.00; // ALTA
        $car = Car::create(['brand_id' => $brandLamborghini->id, 'user_id' => $userLaura->id, 'model' => 'Huracán', 'type' => 'Gasolina', 'description' => 'Superdeportivo italiano con motor V10.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/lamborguini/huracan.png']);
        $car->extras()->attach([$exGPS->id, $exSport->id, $exLed->id]);

        $price = 145000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandAudi->id, 'user_id' => $userDavid->id, 'model' => 'R8 V10', 'type' => 'Gasolina', 'description' => 'Coupé deportivo con motor V10.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/audi/r8.png']);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exAudio->id]);

        $price = 92000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandBMW->id, 'user_id' => null, 'model' => 'M4 Competition', 'type' => 'Gasolina', 'description' => 'Coupé deportivo con motor S58, 510 CV.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/bmw/m4-competition.png']);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 85000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandMercedes->id, 'user_id' => null, 'model' => 'C63 AMG', 'type' => 'Gasolina', 'description' => 'Deportivo alemán con motor V8.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mercedes/c63-amg.png']);
        $car->extras()->attach([$exCuero->id, $exAudio->id, $exTecho->id]);

        $price = 68000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandAudi->id, 'user_id' => null, 'model' => 'RS3 Avant', 'type' => 'Gasolina', 'description' => 'Familiar deportivo con motor turbo, 400 CV.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/audi/rs3-avant.png']);
        $car->extras()->attach([$exGPS->id, $exLed->id]);

        $price = 22500.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandVW->id, 'user_id' => null, 'model' => 'Golf GTI', 'type' => 'Gasolina', 'description' => 'Hatchback deportivo clásico.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/VW/gti.png']);
        $car->extras()->attach([$exGPS->id, $exTecho->id]);

        $price = 18900.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandMini->id, 'user_id' => null, 'model' => 'Mini Cooper S', 'type' => 'Gasolina', 'description' => 'Clásico urbano con motor turbo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mini/mini-chope.png']);
        $car->extras()->attach([$exTecho->id, $exAudio->id]);

        $price = 20000.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandSeat->id, 'user_id' => null, 'model' => 'Leon', 'type' => 'Gasolina', 'description' => 'Compacto español, diseño moderno.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/seat/seta-leon.png']);
        $car->extras()->attach([$exGPS->id]);

        $price = 61828.00; // MEDIA
        $car = Car::create(['brand_id' => $brandFord->id, 'user_id' => null, 'model' => 'Mustang GT', 'type' => 'Gasolina', 'description' => 'El pony car por excelencia.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ford/mustang-GT.png']);
        $car->extras()->attach([$exSport->id, $exAudio->id]);

        $price = 140000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandPorsche->id, 'user_id' => null, 'model' => '911 Carrera', 'type' => 'Gasolina', 'description' => 'La leyenda de Stuttgart.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/porsche/911.png']);
        $car->extras()->attach([$exGPS->id, $exSport->id]);

        $price = 69000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandToyota->id, 'user_id' => null, 'model' => 'GR Supra', 'type' => 'Gasolina', 'description' => 'El retorno del mito japonés.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/toyota/supra.png']);
        $car->extras()->attach([$exSport->id]);

        $price = 105300.00; // MEDIA
        $car = Car::create(['brand_id' => $brandBMW->id, 'user_id' => null, 'model' => 'X5 xDrive', 'type' => 'Híbrido', 'description' => 'SUV de lujo híbrido.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/bmw/x5-xDrive.png']);
        $car->extras()->attach([$exGPS->id, $exCuero->id]);

        $price = 38000.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandMercedes->id, 'user_id' => null, 'model' => 'Clase A', 'type' => 'Gasolina', 'description' => 'El compacto premium.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mercedes/clase-a.png']);
        $car->extras()->attach([$exLed->id]);

        $price = 67552.00; // MEDIA
        $car = Car::create(['brand_id' => $brandMercedes->id, 'user_id' => null, 'model' => 'AMG A45 S', 'type' => 'Gasolina', 'description' => 'El compacto más potente del mundo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mercedes/mercedes-amg-A45.png']);
        $car->extras()->attach([$exLed->id, $exSport->id]);

        $price = 265000.00; // ALTA
        $car = Car::create(['brand_id' => $brandLamborghini->id, 'user_id' => null, 'model' => 'Urus', 'type' => 'Gasolina', 'description' => 'El Super SUV más rápido y versátil del mundo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/lamborguini/urus.png']);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exSport->id, $exAudio->id, $exTecho->id]);

        $price = 38500.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandToyota->id, 'user_id' => null, 'model' => 'Yaris GR', 'type' => 'Gasolina', 'description' => 'Nacido del WRC. Pequeño, tracción total y muy divertido.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/toyota/yaris-gr.png']);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 74000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandPorsche->id, 'user_id' => null, 'model' => '718 Cayman', 'type' => 'Gasolina', 'description' => 'Motor central y equilibrio perfecto para curvas.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/porsche/cayman.png']);
        $car->extras()->attach([$exSport->id, $exAudio->id]);

        $price = 106000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandAudi->id, 'user_id' => null, 'model' => 'e-tron GT', 'type' => 'Eléctrico', 'description' => 'El futuro es eléctrico. Diseño futurista y aceleración instantánea.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/audi/etron-gt.png']);
        $car->extras()->attach([$exGPS->id, $exLed->id, $exTecho->id]);

        $price = 58000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandFord->id, 'user_id' => null, 'model' => 'Ranger Raptor', 'type' => 'Diésel', 'description' => 'Pick-up preparada para saltar dunas y terreno difícil.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ford/ranger-raptor.png']);
        $car->extras()->attach([$exGPS->id, $exSport->id]);

        $price = 56000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandBMW->id, 'user_id' => null, 'model' => 'Z4 Roadster', 'type' => 'Gasolina', 'description' => 'Descapotable biplaza para disfrutar del cielo abierto.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/bmw/z4.png']);
        $car->extras()->attach([$exTecho->id, $exAudio->id]);

        $price = 95000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandMercedes->id, 'user_id' => null, 'model' => 'GLE Coupé', 'type' => 'Híbrido', 'description' => 'SUV elegante con silueta coupé y gran confort.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mercedes/gle-coupe.png']);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exLed->id]);

        $price = 225000.00; // ALTA
        $car = Car::create(['brand_id' => $brandFerrari->id, 'user_id' => null, 'model' => 'Roma', 'type' => 'Gasolina', 'description' => 'La Dolce Vita. Un GT elegante con motor V8 turbo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ferrari/roma.png']);
        $car->extras()->attach([$exCuero->id, $exGPS->id, $exAudio->id]);

        $price = 65000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandVW->id, 'user_id' => null, 'model' => 'Tiguan R', 'type' => 'Gasolina', 'description' => 'SUV familiar pero con 320 CV y escape Akrapovic.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/VW/tiguan-r.png']);
        $car->extras()->attach([$exGPS->id, $exSport->id, $exTecho->id]);

        $price = 19500.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandSeat->id, 'user_id' => null, 'model' => 'Ibiza FR', 'type' => 'Gasolina', 'description' => 'El utilitario joven y dinámico. Ideal para ciudad.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/seat/ibiza-fr.png']);
        $car->extras()->attach([$exLed->id, $exAudio->id]);

        $price = 41000.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandMini->id, 'user_id' => null, 'model' => 'Countryman', 'type' => 'Híbrido', 'description' => 'El Mini más grande y aventurero, ahora híbrido.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mini/countryman.png']);
        $car->extras()->attach([$exGPS->id, $exTecho->id]);

        $price = 39500.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandToyota->id, 'user_id' => null, 'model' => 'RAV4', 'type' => 'Híbrido', 'description' => 'El SUV híbrido más fiable y vendido.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/toyota/rav4.png']);
        $car->extras()->attach([$exGPS->id, $exLed->id]);

        $price = 115000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandPorsche->id, 'user_id' => null, 'model' => 'Panamera', 'type' => 'Híbrido', 'description' => 'Berlina de lujo con prestaciones de deportivo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/porsche/panamera.png']);
        $car->extras()->attach([$exCuero->id, $exAudio->id, $exGPS->id, $exTecho->id]);

        $price = 36000.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandFord->id, 'user_id' => null, 'model' => 'Focus ST', 'type' => 'Gasolina', 'description' => 'Compacto deportivo, divertido y manual.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ford/focus-st.png']);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 88000.00; // MEDIA
        $car = Car::create(['brand_id' => $brandAudi->id, 'user_id' => null, 'model' => 'Q8 S-Line', 'type' => 'Diésel', 'description' => 'El buque insignia de los SUV de Audi. Imponente.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/audi/q8.png']);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exAudio->id, $exTecho->id]);


        // ============================================
        //  REFUERZOS: COMPLETANDO EL OBJETIVO DE 9
        // ============================================

        // --- REFUERZOS GAMA ALTA (Añadimos 6 más para superar los 9) ---
        
        $price = 450000.00; // ALTA
        $car = Car::create(['brand_id' => $brandLamborghini->id, 'user_id' => null, 'model' => 'Aventador SVJ', 'type' => 'Gasolina', 'description' => 'V12 atmosférico, puertas de tijera y sonido celestial.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/lamborguini/aventador.png']);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 230000.00; // ALTA
        $car = Car::create(['brand_id' => $brandPorsche->id, 'user_id' => null, 'model' => '911 Turbo S', 'type' => 'Gasolina', 'description' => 'El rey de la aceleración. 0 a 100 en 2.7 segundos.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/porsche/911-turbo.png']);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exSport->id, $exAudio->id]);

        $price = 550000.00; // ALTA
        $car = Car::create(['brand_id' => $brandFord->id, 'user_id' => null, 'model' => 'Ford GT', 'type' => 'Gasolina', 'description' => 'Un coche de carreras con matrícula. Fibra de carbono pura.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ford/ford-gt.png']);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 340000.00; // ALTA
        $car = Car::create(['brand_id' => $brandFerrari->id, 'user_id' => null, 'model' => '812 Superfast', 'type' => 'Gasolina', 'description' => 'El GT con motor delantero más potente de la historia.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ferrari/812.png']);
        $car->extras()->attach([$exCuero->id, $exGPS->id, $exAudio->id]);

        $price = 360000.00; // ALTA
        $car = Car::create(['brand_id' => $brandMercedes->id, 'user_id' => null, 'model' => 'AMG GT Black Series', 'type' => 'Gasolina', 'description' => 'Récord en Nürburgring. Aerodinámica activa extrema.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/mercedes/amg-gt-black.png']);
        $car->extras()->attach([$exSport->id, $exLed->id]);

        $price = 180000.00; // ALTA
        $car = Car::create(['brand_id' => $brandAudi->id, 'user_id' => null, 'model' => 'R8 Spyder V10', 'type' => 'Gasolina', 'description' => 'Descapotable con motor V10 atmosférico.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/audi/r8-spyder.png']);
        $car->extras()->attach([$exGPS->id, $exCuero->id, $exAudio->id]);


        // --- REFUERZOS OCASIÓN (Añadimos 3 más para ir sobrados) ---

        $price = 32000.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandVW->id, 'user_id' => null, 'model' => 'Polo GTI', 'type' => 'Gasolina', 'description' => 'El hermano pequeño del Golf. Ágil y divertido.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/VW/polo-gti.png']);
        $car->extras()->attach([$exGPS->id, $exSport->id]);

        $price = 29000.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandToyota->id, 'user_id' => null, 'model' => 'Corolla GR Sport', 'type' => 'Híbrido', 'description' => 'Compacto híbrido con estética deportiva.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/toyota/corolla-gr.png']);
        $car->extras()->attach([$exGPS->id, $exLed->id]);

        $price = 34000.00; // OCASIÓN
        $car = Car::create(['brand_id' => $brandFord->id, 'user_id' => null, 'model' => 'Puma ST', 'type' => 'Gasolina', 'description' => 'SUV pequeño con alma de deportivo.', 'price' => $price, 'class' => $getClase($price), 'image' => 'assets/img/ford/puma-st.png']);
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