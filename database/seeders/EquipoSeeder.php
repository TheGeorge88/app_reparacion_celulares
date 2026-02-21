<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipoSeeder extends Seeder
{
    public function run(): void
    {
        $clienteId = DB::table('clientes')->value('id');

        if (!$clienteId) {
            $this->command->warn('No hay clientes. Crea un cliente primero.');
            return;
        }

        $equipos = [
            ['marca' => 'Samsung',  'modelo' => 'Galaxy S23',      'imei' => '351234567890001', 'color' => 'Negro'],
            ['marca' => 'Apple',    'modelo' => 'iPhone 14',        'imei' => '351234567890002', 'color' => 'Blanco'],
            ['marca' => 'Xiaomi',   'modelo' => 'Redmi Note 12',    'imei' => '351234567890003', 'color' => 'Azul'],
            ['marca' => 'Samsung',  'modelo' => 'Galaxy A54',       'imei' => '351234567890004', 'color' => 'Morado'],
            ['marca' => 'Motorola', 'modelo' => 'Moto G84',         'imei' => '351234567890005', 'color' => 'Negro'],
        ];

        foreach ($equipos as $e) {
            DB::table('equipos')->insert([
                'id'         => DB::raw('gen_random_uuid()'),
                'cliente_id' => $clienteId,
                'marca'      => $e['marca'],
                'modelo'     => $e['modelo'],
                'imei'       => $e['imei'],
                'color'      => $e['color'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
