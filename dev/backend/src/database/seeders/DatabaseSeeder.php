<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Extra;
use App\Models\Profile;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userAdmin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@404rpm.com',
            'password' => '1234'
        ]);
        Profile::create([
            'user_id' => $userAdmin->id,
            'surname' => 'Admin',
            'phone' => '600111222',
            'address' => 'Avenida del Software 1, Oficina Central'
        ]);

        $userPepe = User::create([
            'name' => 'Pepe',
            'email' => 'pepe@gmail.com',
            'password' => '1234'
        ]);
        Profile::create([
            'user_id' => $userPepe->id,
            'surname' => 'Garcia',
            'phone' => '666777888',
            'address' => 'Calle Falsa 123, Madrid'
        ]);

        $userMaria = User::create([
            'name' => 'Maria',
            'email' => 'maria@gmail.com',
            'password' => '1234'
        ]);
        Profile::create([
            'user_id' => $userMaria->id,
            'surname' => 'Lopez',
            'phone' => '666999000',
            'address' => 'Plaza Mayor 5, Piso 2A'
        ]);

        $brandToyota = Brand::create(['name' => 'Toyota']);
        $brandFord = Brand::create(['name' => 'Ford']);
        $brandBMW = Brand::create(['name' => 'BMW']);
        $brandTesla = Brand::create(['name' => 'Tesla']);

        $extraGPS = Extra::create([
            'name' => 'Navegador GPS',
            'description' => 'Pantalla de 10 pulgadas con mapas.'
        ]);
        $extraTecho = Extra::create([
            'name' => 'Techo Solar',
            'description' => 'Techo panorámico abatible.'
        ]);
        $extraCuero = Extra::create([
            'name' => 'Asientos de Cuero',
            'description' => 'Tapicería premium calefactable.'
        ]);
        $extraPiloto = Extra::create([
            'name' => 'Piloto Automático',
            'description' => 'Asistencia a la conducción Nivel 2.'
        ]);

        $carCorolla = Car::create([
            'brand_id' => $brandToyota->id,
            'model' => 'Corolla Hybrid',
            'type' => 'Híbrido',
            'description' => 'El híbrido más vendido, ideal para la ciudad',
            'price' => 24500.00
        ]);
        $carCorolla->extras()->attach([
            $extraGPS->id,
            $extraTecho->id
        ]);

        $carMustang = Car::create([
            'brand_id' => $brandFord->id,
            'model' => 'Mustang GT',
            'type' => 'Gasolina',
            'description' => 'Potencia americana en estado puro',
            'price' => 55000.00
        ]);
        $carMustang->extras()->attach([
            $extraCuero->id,
            $extraGPS->id
        ]);

        $carModelY = Car::create([
            'brand_id' => $brandTesla->id,
            'model' => 'Model Y',
            'type' => 'Eléctrico',
            'description' => 'SUV eléctrico familiar con gran autonomía',
            'price' => 48000.00
        ]);
        $carModelY->extras()->attach([
            $extraGPS->id,
            $extraTecho->id,
            $extraCuero->id,
            $extraPiloto->id
        ]);

        $carX5 = Car::create([
            'brand_id' => $brandBMW->id,
            'model' => 'X5 xDrive',
            'type' => 'Diesel',
            'description' => 'Lujo y conford para viajes largos',
            'price' => 72000.00
        ]);
        $carX5->extras()->attach([
            $extraCuero->id,
            $extraTecho->id
        ]);
    }
}
