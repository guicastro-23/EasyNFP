<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classificacao_cst_ibscbs', function (Blueprint $table) {
            $table->id();

            // -------------------------------------------------
            // FK → CLASSIFICAÇÃO TRIBUTÁRIA
            // -------------------------------------------------
            $table->foreignId('classificacao_tributaria_id')
                  ->constrained('classificacoes_tributarias')
                  ->cascadeOnDelete();

            // -------------------------------------------------
            // FK → CST IBS/CBS (CATÁLOGO)
            // -------------------------------------------------
            $table->string('cst_ibscbs_codigo', 3);

            // -------------------------------------------------
            // CONTEXTO (opcional, mas futuro-proof)
            // -------------------------------------------------
            $table->enum(
                'tributo',
                ['ibs', 'cbs', 'ambos']
            )->default('ambos');

            // -------------------------------------------------
            // CONTROLE
            // -------------------------------------------------
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            // -------------------------------------------------
            // CONSTRAINTS
            // -------------------------------------------------
            $table->foreign('cst_ibscbs_codigo')
                  ->references('codigo')
                  ->on('cst_ibscbs')
                  ->restrictOnDelete();

            $table->unique(
                [
                    'classificacao_tributaria_id',
                    'cst_ibscbs_codigo',
                    'tributo'
                ],
                'uniq_classif_cst_ibscbs'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classificacao_cst_ibscbs');
    }
};
