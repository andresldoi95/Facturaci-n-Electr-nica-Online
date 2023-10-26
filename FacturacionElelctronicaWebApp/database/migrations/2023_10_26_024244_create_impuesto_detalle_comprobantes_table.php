<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comp_impuestos_detalles_comprobantes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('detalle_id')->references('id')->on('comp_detalles_comprobantes');
            $table->foreignId('tarifa_id')->index()->references('id')->on('comp_tarifas');
            $table->double('base_imponible', 10, 2)->default(0);
            $table->double('tarifa', 5, 2)->default(0);
            $table->double('valor', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comp_impuestos_detalles_comprobantes');
    }
};
