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
        Schema::create('cst_ibscbs', function (Blueprint $table) {
            $table->string('codigo', 4)->primary();   // Ex: 101, 620, 800
            $table->string('descricao', 255);         // Descrição completa oficial
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cst_ibscbs');
    }
};
