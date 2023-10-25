<?php

namespace Database\Seeders;

use App\Models\General\TipoIdentificacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoIdentificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoIdentificacion::create([
            'codigo_institucion' => '04',
            'nombre' => 'RUC'
        ]);
        TipoIdentificacion::create([
            'codigo_institucion' => '05',
            'nombre' => 'Cédula'
        ]);
        TipoIdentificacion::create([
            'codigo_institucion' => '06',
            'nombre' => 'Pasaporte'
        ]);
        TipoIdentificacion::create([
            'codigo_institucion' => '07',
            'nombre' => 'Venta a consumidor final',
            'identificacion_defecto' => '9999999999999'
        ]);
        TipoIdentificacion::create([
            'codigo_institucion' => '08',
            'nombre' => 'Identificación del exterior'
        ]);
    }
}
