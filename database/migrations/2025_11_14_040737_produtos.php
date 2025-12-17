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
        Schema::create('produtos', function (Blueprint $table){
            $table-> id();

            $table->string('cProd', 60)->unique(); // Codigo do produto 'sku'
            $table->string('xProd', 120); // descriçao do produto 'nome'

            $table->string('cEAN'); // GTIN (Global Trade Item Number) da unidade comercial
            $table->string('cBarra')->nullable(); // Código de barras próprio para unidade comercial
            $table->string('cEANTrib'); // GTIN (Global Trade Item Number) da unidade tributável
            $table->string('cBarraTrib')->nullable(); // Código de barras próprio para unidade tributável

            $table->string('ncm')->index(); // (Nomenclatura Comum do Mercosul)
            $table->string('cest')->nullable();
            $table->string('extipi', 3)->nullable(); // Código de Exceção da TIPI

            $table->string('uCom', 6); // Unidade comercial 
            $table->string('uTrib',6); // Unidade Tributavel 
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
