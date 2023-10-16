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
        Schema::create('gen_establecimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->index();
            $table->string('descripcion');
            $table->string('codigo_institucion', 3);
            $table->string('direccion', 300);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('empresa_id')->references('id')->on('gen_empresas');
            $table->unique([
                'empresa_id', 'codigo_institucion'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gen_establecimientos');
    }
};
