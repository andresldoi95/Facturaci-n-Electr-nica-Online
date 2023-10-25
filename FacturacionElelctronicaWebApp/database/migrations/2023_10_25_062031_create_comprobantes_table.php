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
        Schema::create('comp_comprobantes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('punto_emision_id')->index();
            $table->string('numero_documento', 9);
            $table->dateTime('fecha_emision');
            $table->foreignId('cliente_id')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('punto_emision_id')->references('id')->on('comp_puntos_emision');
            $table->foreign('cliente_id')->references('id')->on('gen_clientes');
            $table->unique(['punto_emision_id', 'numero_documento']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comp_comprobantes');
    }
};
