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
        Schema::create('gen_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->index();
            $table->foreignId('categoria_id')->index();
            $table->string('codigo', 20);
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->double('precio', 15, 6)->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['empresa_id', 'codigo']);
            $table->foreign('empresa_id')->references('id')->on('gen_empresas');
            $table->foreign('categoria_id')->references('id')->on('gen_categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gen_items');
    }
};
