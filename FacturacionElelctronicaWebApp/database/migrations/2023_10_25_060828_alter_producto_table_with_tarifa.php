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
        Schema::table('gen_items', function (Blueprint $table) {
            $table->foreignId('tarifa_id')->nullable()->index();
            $table->foreign('tarifa_id')->references('id')->on('comp_tarifas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
