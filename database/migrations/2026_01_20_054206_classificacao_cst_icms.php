<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classificacao_cst_icms', function (Blueprint $table) {
            $table->id();

            // -------------------------------------------------
            // FK → CLASSIFICAÇÃO TRIBUTÁRIA
            // -------------------------------------------------
            $table->foreignId('classificacao_tributaria_id')
                  ->constrained('classificacoes_tributarias')
                  ->cascadeOnDelete();

            // -------------------------------------------------
            // FK → CST ICMS (CATÁLOGO)
            // -------------------------------------------------
            $table->string('cst_icms_codigo', 3);

            // -------------------------------------------------
            // CONTEXTO DE APLICAÇÃO
            // -------------------------------------------------
            $table->enum(
                'tipo_contribuinte',
                ['pf', 'pf_ie', 'pj', 'pj_ie']
            )->default('pj_ie');

            // -------------------------------------------------
            // CONTROLE
            // -------------------------------------------------
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            // -------------------------------------------------
            // CONSTRAINTS
            // -------------------------------------------------
            $table->foreign('cst_icms_codigo')
                  ->references('codigo')
                  ->on('cst_icms')
                  ->restrictOnDelete();

            $table->unique(
                [
                    'classificacao_tributaria_id',
                    'cst_icms_codigo',
                    'tipo_contribuinte'
                ],
                'uniq_classif_cst_icms'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classificacao_cst_icms');
    }
};
