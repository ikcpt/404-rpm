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
            'description' => 'El hito tecnológico de Maranello y su primer híbrido enchufable (PHEV) de producción en serie. Combina un motor V8 biturbo de 4.0 litros (el V8 más potente en la historia de la marca) con tres motores eléctricos: dos en el eje delantero y uno en el trasero derivado de la F1 (MGUK). La potencia conjunta es de 1.000 CV, permitiendo una aceleración de 0 a 100 km/h en 2,5 segundos y 0 a 200 en 6,7 segundos. Cuenta con tracción total, aerodinámica activa con el sistema "shut-off Gurney" en la parte trasera y un selector eManettino con cuatro modos de gestión de energía: eDrive, Hybrid, Performance y Qualify.', 
            'price' => 550000.00,
            'image' => 'assets/img/ferrari/sf90.png'
        ]);
        $car->extras()->attach([$exCuero->id, $exSport->id]);
        
        $car = Car::create([
            'brand_id' => $brandBMW->id, 
            'user_id' => $userLaura->id, 
            'model' => 'M4 Competition', 
            'type' => 'Gasolina', 
            'description' => 'La versión más radical del coupé deportivo de BMW M. Equipado con el motor S58 de 6 cilindros en línea TwinPower Turbo que entrega 510 CV y 650 Nm de par motor. Incluye transmisión M Steptronic de 8 velocidades con Drivelogic y un sistema de refrigeración optimizado para circuito. Su controvertida pero imponente parrilla vertical mejora el flujo de aire. El chasis cuenta con refuerzos específicos, suspensión adaptativa M y frenos compuestos de alto rendimiento. Interior con asientos M Carbon tipo bucket y sistema M Drive Professional con analizador de derrapes (Drift Analyser).', 
            'price' => 115000.00,
            'image' => 'assets/img/bmw/m4-competition.png'
        ]);
        $car->extras()->attach([$exSport->id, $exGPS->id]);

        $car = Car::create([
            'brand_id' => $brandAudi->id, 
            'user_id' => $userDavid->id, 
            'model' => 'Q7 TDI', 
            'type' => 'Diesel', 
            'description' => 'El buque insignia de los SUV de Audi, configurado para ofrecer la máxima versatilidad con 7 plazas reales abatibles eléctricamente. Motor V6 TDI de 3.0 litros con tecnología Mild-Hybrid de 48V que reduce el consumo y mejora la respuesta. Incorpora suspensión neumática adaptativa que regula la altura y dureza según el terreno, tracción integral Quattro con diferencial central autoblocante y dirección a las cuatro ruedas para mayor agilidad. El interior es un santuario de silencio con doble acristalamiento, sistema de sonido 3D Bang & Olufsen y el Audi Virtual Cockpit Plus de alta resolución.', 
            'price' => 85000.00,
            'image' => 'assets/img/audi/q7.png'
        ]);
        $car->extras()->attach([$exTecho->id, $exAudio->id]);

        $car = Car::create([
            'brand_id' => $brandToyota->id, 
            'user_id' => $userJuan->id, 
            'model' => 'Corolla', 
            'type' => 'Híbrido', 
            'description' => 'El vehículo más vendido de la historia, perfeccionado con la 5ª generación del sistema híbrido eléctrico de Toyota. Ofrece una eficiencia térmica inigualable del 40%, permitiendo rodar en modo eléctrico más del 50% del tiempo en recorridos urbanos sin necesidad de enchufar. Construido sobre la plataforma TNGA-C que baja el centro de gravedad y mejora la rigidez torsional. Equipado de serie con Toyota Safety Sense: sistema pre-colisión, control de crucero adaptativo inteligente y mantenimiento de carril. Climatizador bi-zona con tecnología Nanoe para purificar el aire.', 
            'price' => 24000.00,
            'image' => 'assets/img/toyota/corolla.png'
        ]);

        Car::create([
            'brand_id' => $brandSeat->id, 
            'user_id' => null, 
            'model' => 'Ibiza FR', 
            'type' => 'Gasolina', 
            'description' => 'El acabado FR (Formula Racing) transforma al utilitario español en un deportivo de bolsillo. Estética agresiva con parachoques específicos, doble salida de escape simulada y llantas de aleación de 18 pulgadas "Performance". Suspensión deportiva rebajada en 15mm y tarada más firme para un paso por curva plano. Motor TSI de inyección directa con gestión activa de cilindros para reducir consumos. Interior tecnológico con iluminación ambiental en los aireadores, pantalla flotante de 9,2 pulgadas con Full Link inalámbrico (Apple CarPlay/Android Auto) y asientos deportivos envolventes.', 
            'price' => 18500.00,
            'image' => 'assets/img/seat/ibiza.png'
        ])->extras()->attach([$exLed->id]);

        Car::create([
            'brand_id' => $brandFord->id, 
            'user_id' => null, 
            'model' => 'Focus ST-Line', 
            'type' => 'Diesel', 
            'description' => 'Reconocido por tener el mejor chasis de su segmento, la versión ST-Line acentúa el carácter dinámico con muelles cortos, barras estabilizadoras más rígidas y una dirección más directa. Motor EcoBlue Diesel diseñado para cumplir las normativas Euro 6d con inyección de AdBlue y un consumo en carretera inferior a 4.5L/100km. Exterior con kit de carrocería deportivo, alerón trasero de techo y parrilla tipo panal de abeja. Sistema de infoentretenimiento SYNC 4 con pantalla de 13,2 pulgadas, navegación conectada a la nube y actualizaciones OTA (Over-the-Air).', 
            'price' => 22900.00,
            'image' => 'assets/img/ford/focus.jpg'
        ]);

        Car::create([
            'brand_id' => $brandToyota->id, 
            'user_id' => null, 
            'model' => 'Yaris Hybrid', 
            'type' => 'Híbrido', 
            'description' => 'Coche del Año en Europa. Diseñado sobre la plataforma GA-B para ofrecer un estilo compacto pero con una distancia entre ejes maximizada. Su sistema híbrido utiliza un motor de 1.5 litros de ciclo Atkinson y una batería de iones de litio más ligera y potente, logrando consumos reales de 3,8L/100km en ciudad. Es el único de su segmento con airbag central delantero de serie. Ideal para la jungla urbana gracias a su radio de giro reducido y respuesta eléctrica inmediata en semáforos. Maletero con doble fondo y asientos traseros abatibles 60:40.', 
            'price' => 21000.00,
            'image' => 'assets/img/toyota/yaris.jpg'
        ]);

        Car::create([
            'brand_id' => $brandVW->id, 
            'user_id' => null, 
            'model' => 'Polo GTI', 
            'type' => 'Gasolina', 
            'description' => 'Heredero de las siglas Gran Turismo Inyección. Monta el bloque 2.0 TSI (EA888) del Golf GTI, ajustado a 207 CV y 320 Nm de par. Transmisión DSG de 7 velocidades con levas en el volante y diferencial electrónico XDS para mitigar el subviraje. Acelera de 0 a 100 km/h en 6,5 segundos. Estética inconfundible con la franja roja en la parrilla que se extiende hasta los faros IQ.LIGHT Matrix LED. Interior clásico con tapicería de cuadros "Clark", volante deportivo achatado y Digital Cockpit Pro de 10,25 pulgadas con gráficos específicos Sport.', 
            'price' => 32000.00,
            'image' => 'assets/img/VW/polo.png'
        ])->extras()->attach([$exSport->id]);

        Car::create([
            'brand_id' => $brandAudi->id, 
            'user_id' => null, 
            'model' => 'A3 Sportback', 
            'type' => 'Diesel', 
            'description' => 'La cuarta generación del compacto premium define el estándar en digitalización y acabados. Línea exterior S-Line con parachoques deportivos, taloneras y llantas Audi Sport. Motor 2.0 TDI Evo con sistema de doble dosificación de SCR (Twin Dosing) para minimizar emisiones de NOx. Comportamiento en carretera equilibrado entre confort y dinamismo gracias al Audi Drive Select. Interior minimalista con palanca de cambios "shift-by-wire", salpicadero orientado al conductor, inserciones en aluminio y tapicería mixta tela/cuero con grabado S.', 
            'price' => 34500.00,
            'image' => 'assets/img/audi/a3.png'
        ])->extras()->attach([$exGPS->id, $exTecho->id]);

        Car::create([
            'brand_id' => $brandVW->id, 
            'user_id' => null, 
            'model' => 'Golf GTI 8', 
            'type' => 'Gasolina', 
            'description' => 'El icono de los compactos deportivos en su octava generación, más digital y conectado que nunca. Motor 2.0 TSI de 245 CV. Introduce el nuevo gestor dinámico de marcha (Vehicle Dynamics Manager) que coordina el funcionamiento del diferencial autoblocante delantero VAQ y la suspensión adaptativa DCC, eliminando el subviraje casi por completo. Diseño exterior con parrilla iluminada LED y faros antiniebla en disposición de "X". Interior totalmente digitalizado con Innovision Cockpit, Head-Up Display y asientos deportivos tipo bucket con reposacabezas integrados.', 
            'price' => 46000.00,
            'image' => 'assets/img/VW/golf.png'
        ])->extras()->attach([$exSport->id, $exLed->id]);

        Car::create([
            'brand_id' => $brandFord->id, 
            'user_id' => null, 
            'model' => 'Mustang GT', 
            'type' => 'Gasolina', 
            'description' => 'El deportivo más vendido del mundo. Esencia americana pura con motor V8 "Coyote" de 5.0 litros atmosférico, capaz de entregar 450 CV a 7.000 rpm con un sonido celestial gracias a su escape de válvulas activas con 4 modos (desde Silencioso hasta Pista). Caja de cambios manual de 6 velocidades con sistema "Rev Matching" (punta-tacón automático) o automática de 10. Frenos Brembo de 6 pistones delante, suspensión MagneRide que lee la carretera 1.000 veces por segundo y función "Line Lock" para calentar neumáticos traseros antes de una carrera de aceleración.', 
            'price' => 58000.00,
            'image' => 'assets/img/ford/mustang.png'
        ])->extras()->attach([$exCuero->id, $exSport->id]);

        Car::create([
            'brand_id' => $brandBMW->id, 
            'user_id' => null, 
            'model' => 'M2 Coupé', 
            'type' => 'Gasolina', 
            'description' => 'Considerado por los puristas como el mejor BMW M moderno. Ofrece una receta clásica casi extinta: motor de 6 cilindros en línea biturbo, tracción exclusivamente trasera y una batalla corta para una agilidad extrema. Chasis reforzado derivado de sus hermanos mayores M3/M4 pero en un formato más ligero y compacto. Dirección M Servotronic de alta precisión y diferencial M activo que permite derrapes controlados. Diseño musculoso con pasos de rueda ensanchados significativamente respecto al Serie 2 estándar. Un coche diseñado para generar sonrisas.', 
            'price' => 78000.00,
            'image' => 'assets/img/bmw/m2.png'
        ])->extras()->attach([$exSport->id, $exAudio->id]);

        Car::create([
            'brand_id' => $brandToyota->id, 
            'user_id' => null, 
            'model' => 'GR Supra', 
            'type' => 'Gasolina', 
            'description' => 'El renacimiento de un mito de los 90 bajo la división Gazoo Racing. Biplaza deportivo con configuración clásica: motor delantero longitudinal de 6 cilindros y 340 CV y tracción trasera. Logra la "proporción áurea" entre batalla y ancho de vías (1.55) para un paso por curva perfecto. Reparto de pesos 50:50. Suspensión variable adaptativa y diferencial activo que ajusta el bloqueo de 0 a 100% instantáneamente. Diseño exterior escultural de "doble burbuja" en el techo inspirado en el 2000GT y un interior enfocado al conductor con acabados premium.', 
            'price' => 65000.00,
            'image' => 'assets/img/toyota/supra-mk5.jpg'
        ]);

        Car::create([
            'brand_id' => $brandPorsche->id, 
            'user_id' => null, 
            'model' => '718 Cayman', 
            'type' => 'Gasolina', 
            'description' => 'La referencia absoluta en comportamiento dinámico gracias a su disposición de motor central, situado justo detrás de los asientos. Esto proporciona un equilibrio de masas inigualable y una agilidad felina en cambios de dirección. Motor bóxer turbo de 4 cilindros con 300 CV que empuja con fuerza desde bajas vueltas. Dirección electromecánica directa y precisa típica de Porsche. Interior deportivo con volante de diámetro reducido, consola central elevada inspirada en el Carrera GT y materiales de altísima calidad. Maletero delantero y trasero para escapadas de fin de semana.', 
            'price' => 72000.00,
            'image' => 'assets/img/porshe/cayman.png'
        ])->extras()->attach([$exCuero->id]);

        Car::create([
            'brand_id' => $brandMercedes->id, 
            'user_id' => null, 
            'model' => 'Clase C Estate', 
            'type' => 'Diesel', 
            'description' => 'La combinación perfecta de lujo, tecnología y practicidad familiar. Versión Estate (familiar) con 490 litros de maletero ampliables a 1.510 litros. Motor diesel OM654M electrificado con sistema Mild-Hybrid de 48V (EQ Boost) que añade 20 CV extra y permite la conducción "a vela". Suspensión Agility Control con sistema de amortiguación selectivo para un confort de marcha soberbio en autopista. Interior vanguardista con la enorme pantalla central vertical de 11,9 pulgadas con sistema MBUX de segunda generación, control por voz "Hey Mercedes" y realidad aumentada para navegación.', 
            'price' => 52000.00,
            'image' => 'assets/img/mercedes/clasec.png'
        ])->extras()->attach([$exGPS->id, $exAudio->id]);

        Car::create([
            'brand_id' => $brandBMW->id, 
            'user_id' => null, 
            'model' => 'X3 xDrive', 
            'type' => 'Híbrido', 
            'description' => 'Pionero de los SAV (Sports Activity Vehicle) de tamaño medio. Versión híbrida enchufable xDrive30e que combina un motor gasolina de 4 cilindros con un motor eléctrico integrado en la caja de cambios, sumando 292 CV con la función XtraBoost. Autonomía eléctrica de hasta 50 km (WLTP), ideal para desplazamientos diarios sin emisiones. Tracción total inteligente xDrive que reparte el par entre ejes en milisegundos. Maletero de 450 litros a pesar de las baterías. Acabados interiores de lujo con tapicería Vernasca y sistema operativo BMW 7.0.', 
            'price' => 61000.00,
            'image' => 'assets/img/bmw/x3.png'
        ])->extras()->attach([$exTecho->id, $exLed->id]);
        
        Car::create([
            'brand_id' => $brandAudi->id, 
            'user_id' => null, 
            'model' => 'RS6 Avant', 
            'type' => 'Gasolina', 
            'description' => 'Un superdeportivo disfrazado de familiar. Impulsado por un V8 4.0 TFSI biturbo que desarrolla 600 CV y 800 Nm de par. Acelera de 0 a 100 km/h en solo 3,6 segundos. Cuenta con sistema Mild-Hybrid de 48V y desconexión de cilindros (Cylinder on Demand) para mejorar la eficiencia. Estética brutal con carrocería ensanchada 40mm por lado, llantas de 22 pulgadas y difusor trasero RS. Suspensión neumática adaptativa RS de serie o Dynamic Ride Control opcional. Es el coche definitivo para quien lo quiere todo: espacio, lujo y prestaciones de infarto.', 
            'price' => 145000.00,
            'image' => 'assets/img/audi/rs6.png'
        ]);
        
        Car::create([
            'brand_id' => $brandPorsche->id, 
            'user_id' => null, 
            'model' => '911 Carrera', 
            'type' => 'Gasolina', 
            'description' => 'El corazón de la marca Porsche y el deportivo más famoso del mundo (código 992). Fiel a su herencia con motor bóxer de 6 cilindros biturbo montado en el eje trasero, entregando 385 CV. Transmisión de doble embrague PDK de 8 velocidades, considerada la mejor del mercado por su rapidez. Introduce el modo "Wet" de serie para detectar calzada mojada y ajustar los sistemas de estabilidad. Diseño atemporal con pasos de rueda traseros anchos y barra de luces LED continua. Un coche capaz de rodar en circuito por la mañana e ir a la ópera por la noche.', 
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