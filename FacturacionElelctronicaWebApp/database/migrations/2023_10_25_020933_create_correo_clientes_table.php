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
        Schema::create('gen_correos_clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->index();
            $table->string('email');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->foreign('cliente_id')->references('id')->on('gen_clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gen_correos_clientes');
    }
};
