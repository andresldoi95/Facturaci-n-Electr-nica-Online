<?php

namespace Database\Seeders;

use App\Models\Comprobantes\Impuesto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImpuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Impuesto::create([
            'codigo_institucion' => '2',
            'nombre' => 'IVA'
        ]);
    }
}
