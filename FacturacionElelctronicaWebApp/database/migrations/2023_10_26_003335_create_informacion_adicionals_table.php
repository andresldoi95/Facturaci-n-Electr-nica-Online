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
        Schema::create('comp_informacion_adicional', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('comprobante_id')->references('id')->on('comp_comprobantes');
            $table->string('clave', 300);
            $table->string('valor', 300);
            $table->boolean('mostrar')->default(true);
            $table->boolean('enviar')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comp_informacion_adicional');
    }
};
