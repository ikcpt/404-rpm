<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. LIMPIEZA SEGURA DE TABLAS
        |--------------------------------------------------------------------------
        */
        Schema::disableForeignKeyConstraints();

        DB::table('reviews')->delete();
        DB::table('car_extras')->delete();
        DB::table('cars')->delete();
        DB::table('extras')->delete();
        DB::table('brands')->delete();
        DB::table('profiles')->delete();
        DB::table('users')->delete();

        Schema::enableForeignKeyConstraints();

        /*
        |--------------------------------------------------------------------------
        | 2. USUARIOS + PERFILES
        |--------------------------------------------------------------------------
        */
        $users = [
            ['name' => 'Admin Boss', 'email' => 'admin@404rpm.com', 'surname' => 'System', 'phone' => '600000001', 'address' => 'Oficina Central'],
            ['name' => 'Carlos', 'email' => 'carlos.vip@email.com', 'surname' => 'Slim', 'phone' => '600999888', 'address' => 'La Finca, Madrid'],
            ['name' => 'Laura', 'email' => 'laura.racing@email.com', 'surname' => 'Gómez', 'phone' => '611223344', 'address' => 'Valencia Centro'],
            ['name' => 'David', 'email' => 'david.padre@email.com', 'surname' => 'Fernández', 'phone' => '622334455', 'address' => 'Sevilla'],
            ['name' => 'Elena', 'email' => 'elena.new@email.com', 'surname' => 'Vázquez', 'phone' => '633445566', 'address' => 'Barcelona'],
            ['name' => 'Juan Pérez', 'email' => 'juan.perez@email.com', 'surname' => 'Pérez', 'phone' => '644556677', 'address' => 'Bilbao'],
        ];

        foreach ($users as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('1234'),
            ]);

            Profile::create([
                'user_id' => $user->id,
                'surname' => $data['surname'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. BRANDS
        |--------------------------------------------------------------------------
        */
        DB::table('brands')->insert([
            ['name' => 'Porsche', 'country' => 'Alemania'],
            ['name' => 'Ferrari', 'country' => 'Italia'],
            ['name' => 'Lamborghini', 'country' => 'Italia'],
            ['name' => 'Audi', 'country' => 'Alemania'],
            ['name' => 'BMW', 'country' => 'Alemania'],
            ['name' => 'Mercedes-Benz', 'country' => 'Alemania'],
            ['name' => 'Ford', 'country' => 'EEUU'],
            ['name' => 'Volkswagen', 'country' => 'Alemania'],
            ['name' => 'Mini', 'country' => 'Reino Unido'],
            ['name' => 'Seat', 'country' => 'España'],
            ['name' => 'Toyota', 'country' => 'Japón'],
            ['name' => 'Aston Martin', 'country' => 'Reino Unido'],
        ]);

        $brands = DB::table('brands')->pluck('id', 'name');

        /*
        |--------------------------------------------------------------------------
        | 4. EXTRAS
        |--------------------------------------------------------------------------
        */
        DB::table('extras')->insert([
            ['name' => 'Asientos Calefactables'],
            ['name' => 'Techo Solar Panorámico'],
            ['name' => 'Frenos Cerámicos'],
            ['name' => 'Sistema de Sonido Premium'],
            ['name' => 'Asistente de Aparcamiento Automático'],
            ['name' => 'Head-Up Display'],
            ['name' => 'Paquete de Fibra de Carbono'],
            ['name' => 'Suspensión Adaptativa'],
        ]);

        $extras = DB::table('extras')->pluck('id', 'name');

        /*
        |--------------------------------------------------------------------------
        | 5. CARS
        |--------------------------------------------------------------------------
        */
        DB::table('cars')->insert([
            [
                'brand_id' => $brands['Porsche'],
                'model' => '911 GT3 RS',
                'price' => 280000,
                'year' => 2024,
                'type' => 'Gasolina',
                'image' => 'https://placehold.co/600x400/212529/FFF?text=Porsche+911+GT3+RS',
                'description' => 'La máquina definitiva para circuito homologada para la calle.',
            ],
            [
                'brand_id' => $brands['Ferrari'],
                'model' => 'F8 Tributo',
                'price' => 290000,
                'year' => 2023,
                'type' => 'Gasolina',
                'image' => 'https://placehold.co/600x400/d63031/FFF?text=Ferrari+F8+Tributo',
                'description' => 'Diseño italiano y prestaciones de infarto.',
            ],
            [
                'brand_id' => $brands['Ferrari'],
                'model' => 'SF90 Stradale',
                'price' => 530000,
                'year' => 2024,
                'type' => 'Híbrido',
                'image' => 'https://placehold.co/600x400/d63031/FFF?text=Ferrari+SF90',
                'description' => 'El primer híbrido enchufable de Ferrari.',
            ],
        ]);

        $cars = DB::table('cars')->pluck('id', 'model');

        /*
        |--------------------------------------------------------------------------
        | 6. CAR_EXTRAS (PIVOT)
        |--------------------------------------------------------------------------
        */
        DB::table('car_extras')->insert([
            ['car_id' => $cars['911 GT3 RS'], 'extra_id' => $extras['Frenos Cerámicos']],
            ['car_id' => $cars['911 GT3 RS'], 'extra_id' => $extras['Paquete de Fibra de Carbono']],
            ['car_id' => $cars['911 GT3 RS'], 'extra_id' => $extras['Suspensión Adaptativa']],

            ['car_id' => $cars['F8 Tributo'], 'extra_id' => $extras['Frenos Cerámicos']],
            ['car_id' => $cars['F8 Tributo'], 'extra_id' => $extras['Sistema de Sonido Premium']],
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