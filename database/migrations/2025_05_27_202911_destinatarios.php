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
        Schema::create('destinatarios', function (Blueprint $table) {
            $table->id();

            $table->string('cpf', 11)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->string('id_estrangeiro')->nullable();
            $table->string('xnome', 60); // Nome/Razão Social (xNome)

            // Chave estrangeira para endereço do destinatário
            $table->foreignId('endereco_id')->constrained('enderecos')->onDelete('cascade');

            $table->unsignedTinyInteger('ind_ie_dest'); // 1, 2 ou 9
            $table->string('ie', 14)->nullable();   // Inscrição Estadual
            $table->string('isuf')->nullable();     // SUFRAMA
            $table->string('im', 15)->nullable();   // Inscrição Municipal
            $table->string('email', 60)->nullable();

            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinatarios');
    }
};
