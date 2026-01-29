<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('naturezas_operacao', function (Blueprint $table) {
            $table->id();

            // -------------------------------------------------
            // IDENTIFICAÇÃO
            // -------------------------------------------------
           
            $table->string('natOp', 60);
            $table->string('descricao', 120)->nullable();
            $table->boolean('ativo')->default(true);

            // -------------------------------------------------
            // TIPO DA OPERAÇÃO (tpNF)
            // -------------------------------------------------
            $table->enum('tpNF', ['0', '1']);

            // -------------------------------------------------
            // INDICADORES DA NF-e
            // -------------------------------------------------
            $table->string('finNFe', 2);
            $table->string('idDest', 1)->default('1');
            $table->string('indFinal', 1)->default('0');
            $table->string('indPres', 1)->default('1');

            // -------------------------------------------------
            // CFOP BASE (opcional)
            // -------------------------------------------------
            $table->string('cfop_codigo', 4)->nullable();
            $table->foreign(
                'cfop_codigo',
                'fk_natop_cfop'
            )->references('codigo')
             ->on('cfops')
             ->restrictOnDelete();

            // -------------------------------------------------
            // CLASSIFICAÇÃO TRIBUTÁRIA (NÚCLEO FISCAL)
            // -------------------------------------------------
            $table->unsignedBigInteger('classificacao_tributaria_id')->nullable();

            $table->foreign(
                'classificacao_tributaria_id',
                'fk_natop_classif'
            )->references('id')
             ->on('classificacoes_tributarias')
             ->restrictOnDelete();

            // -------------------------------------------------
            // AUDITORIA
            // -------------------------------------------------
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('naturezas_operacao');
    }
};
