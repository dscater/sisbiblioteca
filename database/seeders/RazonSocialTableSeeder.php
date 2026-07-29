<?php

namespace Database\Seeders;

use App\Models\RazonSocial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RazonSocialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RazonSocial::create([
            'nombre' => 'EMPRESA PRUEBA',
            'alias' => 'CP',
            'ciudad' => 'LA PAZ',
            'dir' => 'ZONA LOS OLIVOS CALLE 3 #3232',
            'fono' => '21134568',
            'cel' => '78945612',
            'casilla' => '',
            'correo' => '',
            'logo' => 'logo.png',
            'web' => '',
            'actividad_economica' => 'ACTIVIDAD ECONOMICA',
        ]);
    }
}
