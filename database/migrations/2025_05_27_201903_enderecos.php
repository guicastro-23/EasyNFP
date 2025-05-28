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

        $table->string('logradouro', 60);
        $table->string('numero', 60);
        $table->string('complemento', 60)->nullable();
        $table->string('bairro', 255);
        $table->string('cidade', 60);
        $table->string('uf', 2);
        $table->string('cep', 20);
        $table->string('pais', 60)->default('Brasil');
        $table->string('codigo_municipio', 20);
        $table->string('codigo_pais', 10)->default('1058');

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
