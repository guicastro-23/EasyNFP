<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classificacoes_tributarias', function (Blueprint $table) {
            $table->id();

            // -------------------------------------------------
            // IDENTIFICAÇÃO
            // -------------------------------------------------
            $table->string('codigo', 20)->nullable(); // cClassTrib (quando aplicável)
            $table->string('descricao', 255);
            $table->boolean('ativo')->default(true);

            // -------------------------------------------------
            // ESCOPO DE USO
            // -------------------------------------------------
            $table->enum('tipo_operacao', ['entrada', 'saida', 'ambos'])->default('ambos');
            $table->enum('regime', ['simples', 'normal', 'ambos'])->default('ambos');

            // -------------------------------------------------
            // ICMS (REGRAS)
            // -------------------------------------------------
            $table->boolean('icms_incide')->default(true);
            $table->boolean('icms_st')->default(false);
            $table->boolean('icms_isento')->default(false);
            $table->boolean('icms_diferido')->default(false);
            $table->boolean('icms_monofasico')->default(false);
            $table->boolean('icms_reducao_bc')->default(false);
            $table->boolean('icms_gera_credito')->default(false);

            // -------------------------------------------------
            // PIS / COFINS (REGRAS)
            // -------------------------------------------------
            $table->boolean('pis_incide')->default(true);
            $table->boolean('pis_gera_credito')->default(false);

            $table->boolean('cofins_incide')->default(true);
            $table->boolean('cofins_gera_credito')->default(false);

            // -------------------------------------------------
            // CRÉDITO PRESUMIDO
            // -------------------------------------------------
            $table->boolean('permite_credito_presumido')->default(false);
            $table->enum(
                'credito_presumido_tipo',
                ['icms', 'pis', 'cofins', 'ibs', 'cbs']
            )->nullable();
            $table->enum(
                'credito_presumido_apropriacao',
                ['nfe', 'evento']
            )->nullable();
            $table->string('credito_presumido_base_legal', 255)->nullable();

            // -------------------------------------------------
            // IBS / CBS (REFORMA TRIBUTÁRIA)
            // -------------------------------------------------
            $table->boolean('ibs_incide')->default(false);
            $table->boolean('ibs_isento')->default(false);
            $table->boolean('ibs_reducao')->default(false);
            $table->boolean('gera_credito_ibs')->default(false);

            $table->boolean('cbs_incide')->default(false);
            $table->boolean('cbs_isento')->default(false);
            $table->boolean('cbs_reducao')->default(false);
            $table->boolean('gera_credito_cbs')->default(false);

            // -------------------------------------------------
            // REGRAS TÉCNICAS / VALIDAÇÃO
            // -------------------------------------------------
            $table->boolean('bloqueia_cst_manual')->default(true);
            $table->boolean('exige_ibscbs_xml')->default(false);
            $table->boolean('permite_valor_zero')->default(false);

            // -------------------------------------------------
            // AUDITORIA
            // -------------------------------------------------
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classificacoes_tributarias');
    }
};
