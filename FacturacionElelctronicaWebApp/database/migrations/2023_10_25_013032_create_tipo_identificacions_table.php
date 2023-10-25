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
        Schema::create('gen_tipos_identificacion', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_institucion', 2)->unique();
            $table->string('nombre');
            $table->string('descripcion', 300)->nullable();
            $table->string('identificacion_defecto', 20)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gen_tipos_identificacion');
    }
};
