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
        Schema::create('compromisosdepagos', function (Blueprint $table) {
            $table->id();
            
            $table->string('Fecha_de_compromiso');
            $table->string('Concepto_de_pago');
            $table->string('Claves_referencias');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compromisosdepagos');
    }
};
