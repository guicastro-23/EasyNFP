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
        Schema::create('enderecos_emitente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained()->onDelete('cascade');
            $table->string('logradouro', 255);
            $table->string('numero', 255);
            $table->string('complemento', 500)->nullable();
            $table->string('bairro', 255);
            $table->string('cidade', 255);
            $table->string('uf', 2); 
            $table->string('cep', 20);
            $table->string('pais', 255)->default('Brasil');
            $table->string('codigo_municipio', 20);
            $table->string('codigo_pais', 10)->default('1058'); // Código padrão Brasil

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos_emitente');
    }
};
