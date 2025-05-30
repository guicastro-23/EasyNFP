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
        Schema::create('enderecos', function (Blueprint $table) {
        $table->id();

        $table->string('tipo', 50); // Ex: 'entrega', 'retirada', 'destinatario'

        $table->string('xlgr', 60); // logradouro
        $table->string('nro', 60); // numero
        $table->string('xCpl', 60)->nullable(); // complemento
        $table->string('xBairro', 255); // bairro
        $table->string('cMun', 20); // Código do municipio
        $table->string('xMun', 60); // Nome do municipio
        $table->string('UF', 2);
        $table->string('CEP', 20);
        $table->string('cPais', 10)->default('1058'); // Código do Pais
        $table->string('xPais', 60)->default('Brasil');
        $table->string('fone')->nullable();
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::dropIfExists('enderecos');
    }
};
