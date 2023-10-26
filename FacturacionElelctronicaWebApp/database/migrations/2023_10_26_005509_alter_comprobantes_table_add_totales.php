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
        Schema::table('comp_comprobantes', function (Blueprint $table) {
            $table->double('subtotal_si', 10, 2)->default(0);
            $table->double('descuento_total', 10, 2)->default(0);
            $table->double('subtotal', 10, 2)->default(0);
            $table->double('impuestos', 10, 2)->default(0);
            $table->double('total', 10, 2)->default(0);
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
