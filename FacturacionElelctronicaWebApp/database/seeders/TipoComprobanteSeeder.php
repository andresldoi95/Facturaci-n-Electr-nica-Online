<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\General\TipoComprobante;

class TipoComprobanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoComprobante::create([
            'codigo_institucion' => '01',
            'nombre' => 'Factura',
        ]);
        // TipoComprobante::create([
        //     'codigo_institucion' => '03',
        //     'nombre' => 'Liquidación de compra de bienes y prestación de servicios',
        // ]);
        // TipoComprobante::create([
        //     'codigo_institucion' => '04',
        //     'nombre' => 'Nota de crédito',
        // ]);
        // TipoComprobante::create([
        //     'codigo_institucion' => '05',
        //     'nombre' => 'Nota de débito',
        // ]);
        // TipoComprobante::create([
        //     'codigo_institucion' => '06',
        //     'nombre' => 'Guía de remisión',
        // ]);
        // TipoComprobante::create([
        //     'codigo_institucion' => '07',
        //     'nombre' => 'Comprobante de retención',
        // ]);
    }
}
