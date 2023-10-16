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
        Schema::create('comp_puntos_emision', function (Blueprint $table) {
            $table->id();
            $table->foreignId('establecimiento_id')->index();
            $table->foreignId('tipo_comprobante_id')->index();
            $table->string('nombre');
            $table->string('codigo_emisor', 3);
            $table->string('numero_inicial', 9)->default('1');
            $table->boolean('electronico')->default(true);
            $table->timestamps();
            $table->foreign('establecimiento_id')->references('id')->on('gen_establecimientos');
            $table->foreign('tipo_comprobante_id')->references('id')->on('gen_tipos_comprobante');
            $table->unique([
                'establecimiento_id', 'tipo_comprobante_id', 'codigo_emisor'
            ], 'uq_punto_emision');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comp_puntos_emision');
    }
};
