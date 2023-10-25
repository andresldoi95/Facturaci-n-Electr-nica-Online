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
        Schema::create('gen_clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_identificacion_id')->index();
            $table->string('numero_identificacion', 20)->unique();
            $table->string('nombre_razon_social', 500);
            $table->string('nombre_comercial')->nullable();
            $table->string('direccion', 300);
            $table->string('observacion', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tipo_identificacion_id')->references('id')->on('gen_tipos_identificacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gen_clientes');
    }
};
