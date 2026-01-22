<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classificacao_cst_cofins', function (Blueprint $table) {
            $table->id();

            // -------------------------------------------------
            // FK → CLASSIFICAÇÃO TRIBUTÁRIA
            // -------------------------------------------------
            $table->foreignId('classificacao_tributaria_id')
                  ->constrained('classificacoes_tributarias')
                  ->cascadeOnDelete();

            // -------------------------------------------------
            // FK → CST COFINS (CATÁLOGO)
            // -------------------------------------------------
            $table->string('cst_cofins_codigo', 2);

            // -------------------------------------------------
            // CONTROLE
            // -------------------------------------------------
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            // -------------------------------------------------
            // CONSTRAINTS
            // -------------------------------------------------
            $table->foreign('cst_cofins_codigo')
                  ->references('codigo')
                  ->on('cst_cofins')
                  ->restrictOnDelete();

            $table->unique(
                [
                    'classificacao_tributaria_id',
                    'cst_cofins_codigo'
                ],
                'uniq_classif_cst_cofins'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classificacao_cst_cofins');
    }
};
