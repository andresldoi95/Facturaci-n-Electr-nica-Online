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
        Schema::create('comp_tarifas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('impuesto_id')->index();
            $table->string('codigo_institucion', 10);
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->double('porcentaje', 8, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->unique([
                'impuesto_id', 'codigo_institucion'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comp_tarifas');
    }
};
