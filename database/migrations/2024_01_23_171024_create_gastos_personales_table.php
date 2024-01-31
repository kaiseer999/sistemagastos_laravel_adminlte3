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
        Schema::create('gastos_personales', function (Blueprint $table) {
            $table->id();

            $table->string('mes');

            $table->unsignedBigInteger('compromiso_pago_id')->nullable(); 
            $table->foreign('compromiso_pago_id')->references('id')->on('compromisosdepagos')
            ->onDelete('set null')
            ->onUpdate('set null');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')->onDelete('set null');

            $table->date('fecha_de_pago');  
            $table->bigInteger('valor_de_pago');  
            $table->json('soporte_de_pago');  
            $table->text('observacion', 256);
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos_personales');
    }
};
