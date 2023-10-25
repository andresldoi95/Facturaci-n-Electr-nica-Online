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
        Schema::create('comp_detalles_comprobantes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('comprobante_id')->references('id')->on('comp_comprobantes');
            $table->foreignId('item_id')->references('id')->on('gen_items');
            $table->double('cantidad', 15, 6)->default(1);
            $table->double('precio', 15, 6)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comp_detalles_comprobantes');
    }
};
