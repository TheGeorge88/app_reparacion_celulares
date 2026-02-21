<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Pantalla OLED',           'descripcion' => 'Pantallas OLED para celulares'],
            ['nombre' => 'Pantalla AMOLED',          'descripcion' => 'Pantallas AMOLED para celulares'],
            ['nombre' => 'Pantalla LCD',             'descripcion' => 'Pantallas LCD para celulares'],
            ['nombre' => 'Táctil (Touch)',            'descripcion' => 'Digitalizador o vidrio táctil'],
            ['nombre' => 'Batería',                  'descripcion' => 'Baterías de reemplazo'],
            ['nombre' => 'Puerto de carga',          'descripcion' => 'Conectores y puertos de carga'],
            ['nombre' => 'Flex de carga',            'descripcion' => 'Flex y cables de carga internos'],
            ['nombre' => 'Cámara trasera',           'descripcion' => 'Módulos de cámara trasera'],
            ['nombre' => 'Cámara frontal',           'descripcion' => 'Módulos de cámara frontal'],
            ['nombre' => 'Micrófono',                'descripcion' => 'Micrófonos de repuesto'],
            ['nombre' => 'Parlante / Altavoz',       'descripcion' => 'Altavoces y parlantes'],
            ['nombre' => 'Auricular',                'descripcion' => 'Auriculares internos (earpiece)'],
            ['nombre' => 'Botón de encendido',       'descripcion' => 'Botón de encendido / apagado'],
            ['nombre' => 'Botones de volumen',       'descripcion' => 'Botones de subir y bajar volumen'],
            ['nombre' => 'Bandeja SIM',              'descripcion' => 'Bandeja para tarjeta SIM'],
            ['nombre' => 'Lector de huella',         'descripcion' => 'Sensor lector de huella digital'],
            ['nombre' => 'Tapa trasera',             'descripcion' => 'Tapa o carcasa trasera'],
            ['nombre' => 'Vidrio trasero',           'descripcion' => 'Vidrio trasero del equipo'],
            ['nombre' => 'Placa base (Mainboard)',   'descripcion' => 'Placa base o tarjeta madre'],
            ['nombre' => 'Conector de audífonos',    'descripcion' => 'Jack de audio 3.5mm'],
            ['nombre' => 'Antena de señal',          'descripcion' => 'Antenas de señal y conectores'],
            ['nombre' => 'Vibrador',                 'descripcion' => 'Motor vibrador'],
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'id' => DB::raw('gen_random_uuid()'),
                'nombre' => $categoria['nombre'],
                'descripcion' => $categoria['descripcion'],
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
