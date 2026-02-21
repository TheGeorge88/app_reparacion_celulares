<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TecnicoSeeder extends Seeder
{
    public function run(): void
    {
        $tecnicos = [
            ['nombre' => 'Carlos Mendoza',   'email' => 'carlos.mendoza@taller.com',   'especialidad' => 'Reparación de pantallas'],
            ['nombre' => 'Luis Torres',       'email' => 'luis.torres@taller.com',       'especialidad' => 'Carga y batería'],
            ['nombre' => 'Andrés García',     'email' => 'andres.garcia@taller.com',     'especialidad' => 'Placa base'],
            ['nombre' => 'Miguel Rodríguez',  'email' => 'miguel.rodriguez@taller.com',  'especialidad' => 'Reparación general'],
            ['nombre' => 'José Morales',      'email' => 'jose.morales@taller.com',      'especialidad' => 'Cámaras y sensores'],
            ['nombre' => 'Daniel Herrera',    'email' => 'daniel.herrera@taller.com',    'especialidad' => 'Software y actualización'],
            ['nombre' => 'Kevin López',       'email' => 'kevin.lopez@taller.com',       'especialidad' => 'Reparación general'],
            ['nombre' => 'Bryan Sánchez',     'email' => 'bryan.sanchez@taller.com',     'especialidad' => 'Audio y parlantes'],
            ['nombre' => 'Juan Castillo',     'email' => 'juan.castillo@taller.com',     'especialidad' => 'Conectores y puertos'],
            ['nombre' => 'David Pérez',       'email' => 'david.perez@taller.com',       'especialidad' => 'Reparación de pantallas'],
        ];

        foreach ($tecnicos as $t) {
            $userId = DB::table('users')->insertGetId([
                'id'         => DB::raw('gen_random_uuid()'),
                'name'       => $t['nombre'],
                'email'      => $t['email'],
                'password'   => Hash::make('tecnico123'),
                'created_at' => now(),
                'updated_at' => now(),
            ], 'id');

            DB::table('tecnicos')->insert([
                'id'          => DB::raw('gen_random_uuid()'),
                'user_id'     => $userId,
                'especialidad'=> $t['especialidad'],
                'activo'      => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
