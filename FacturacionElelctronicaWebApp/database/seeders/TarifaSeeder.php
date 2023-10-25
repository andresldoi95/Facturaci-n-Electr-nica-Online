<?php

namespace Database\Seeders;

use App\Models\Comprobantes\Impuesto;
use App\Models\Comprobantes\Tarifa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TarifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $iva = Impuesto::where('codigo_institucion', '2')->first();
        if (isset($iva))
        {
            Tarifa::create([
                'codigo_institucion' => '0',
                'nombre' => 'IVA 0%',
                'porcentaje' => 0,
                'impuesto_id' => $iva->id
            ]);
            Tarifa::create([
                'codigo_institucion' => '2',
                'nombre' => 'IVA 12%',
                'porcentaje' => 12,
                'impuesto_id' => $iva->id
            ]);
        }
    }
}
