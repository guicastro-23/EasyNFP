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
        Schema::create('empresas', function (Blueprint $table ) {
            $table->id();
            $table->enum('tipo_pessoa', ['cnpj', 'cpf']);
            $table->string('cpf_cnpj', 14); // aceita CPF (11) ou CNPJ (14)
            $table->string('inscricao_estadual', 50)->nullable();
            $table->string('inscricao_municipal', 50)->nullable();
            $table->string('nome_razao_social', 500);
            $table->string('nome_fantasia', 500)->nullable();
            $table->string('fone')->nullable();
            $table->string('email');

        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
