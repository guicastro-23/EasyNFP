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
        Schema::create('naturezas_operacao', function (Blueprint $table) {
             $table->id();

            // Informações gerais
            $table->string('descricao', 120);
            $table->string('natOp', 60);
            $table->string('tpNF', 1);  // 0 entrada, 1 saída
            $table->string('finNFe', 2);
            $table->string('idDest', 2)->default('1');
            $table->string('indFinal', 1)->default('0');
            $table->string('indPres', 1)->default('1');

            // --------------------------------------------------------------------
            // TRIBUTAÇÃO PESSOA FÍSICA COM IE
            // --------------------------------------------------------------------
            $table->string('pf_ie_cst_icms', 3)->nullable();
            $table->string('pf_ie_cst_pis', 3)->nullable();
            $table->string('pf_ie_cst_cofins', 3)->nullable();
            $table->string('pf_ie_cfop', 4)->nullable();

            // --------------------------------------------------------------------
            // TRIBUTAÇÃO PESSOA FÍSICA SEM IE
            // --------------------------------------------------------------------
            $table->string('pf_no_ie_cst_icms', 3)->nullable();
            $table->string('pf_no_ie_cst_pis', 3)->nullable();
            $table->string('pf_no_ie_cst_cofins', 3)->nullable();
            $table->string('pf_no_ie_cfop', 4)->nullable();

            // --------------------------------------------------------------------
            // TRIBUTAÇÃO PESSOA JURÍDICA COM IE
            // --------------------------------------------------------------------
            $table->string('pj_ie_cst_icms', 3)->nullable();
            $table->string('pj_ie_cst_pis', 3)->nullable();
            $table->string('pj_ie_cst_cofins', 3)->nullable();
            $table->string('pj_ie_cfop', 4)->nullable();

            // --------------------------------------------------------------------
            // TRIBUTAÇÃO PESSOA JURÍDICA SEM IE
            // --------------------------------------------------------------------
            $table->string('pj_no_ie_cst_icms', 3)->nullable();
            $table->string('pj_no_ie_cst_pis', 3)->nullable();
            $table->string('pj_no_ie_cst_cofins', 3)->nullable();
            $table->string('pj_no_ie_cfop', 4)->nullable();

            // TRIBUTAÇÃO – SIMPLES NACIONAL (CSOSN)
            $table->string('pf_ie_csosn', 3)->nullable();
            $table->string('pf_no_ie_csosn', 3)->nullable();
            $table->string('pj_ie_csosn', 3)->nullable();
            $table->string('pj_no_ie_csosn', 3)->nullable();

            // --------------------------------------------------------------------
            // CHAVES ESTRANGEIRAS – CST ICMS
            // --------------------------------------------------------------------
            $table->foreign('pf_ie_cst_icms')->references('codigo')->on('cst_icms')->restrictOnDelete();
            $table->foreign('pf_no_ie_cst_icms')->references('codigo')->on('cst_icms')->restrictOnDelete();
            $table->foreign('pj_ie_cst_icms')->references('codigo')->on('cst_icms')->restrictOnDelete();
            $table->foreign('pj_no_ie_cst_icms')->references('codigo')->on('cst_icms')->restrictOnDelete();

            // --------------------------------------------------------------------
            // CHAVES ESTRANGEIRAS – CST PIS
            // --------------------------------------------------------------------
            $table->foreign('pf_ie_cst_pis')->references('codigo')->on('cst_pis')->restrictOnDelete();
            $table->foreign('pf_no_ie_cst_pis')->references('codigo')->on('cst_pis')->restrictOnDelete();
            $table->foreign('pj_ie_cst_pis')->references('codigo')->on('cst_pis')->restrictOnDelete();
            $table->foreign('pj_no_ie_cst_pis')->references('codigo')->on('cst_pis')->restrictOnDelete();

            // --------------------------------------------------------------------
            // CHAVES ESTRANGEIRAS – CST COFINS
            // --------------------------------------------------------------------
            $table->foreign('pf_ie_cst_cofins')->references('codigo')->on('cst_cofins')->restrictOnDelete();
            $table->foreign('pf_no_ie_cst_cofins')->references('codigo')->on('cst_cofins')->restrictOnDelete();
            $table->foreign('pj_ie_cst_cofins')->references('codigo')->on('cst_cofins')->restrictOnDelete();
            $table->foreign('pj_no_ie_cst_cofins')->references('codigo')->on('cst_cofins')->restrictOnDelete();

            // --------------------------------------------------------------------
            // CHAVES ESTRANGEIRAS – CFOP
            // --------------------------------------------------------------------
            $table->foreign('pj_ie_cfop')->references('codigo')->on('cfop')->restrictOnDelete();
            $table->foreign('pj_no_ie_cfop')->references('codigo')->on('cfop')->restrictOnDelete();

            $table->foreign('pj_ie_csosn')->references('codigo')->on('csosn')->restrictOnDelete();
            $table->foreign('pj_no_ie_csosn')->references('codigo')->on('csosn')->restrictOnDelete();


            // IBS / CBS (Reforma Tributária)
            $table->string('ibs_cst', 4)->nullable();       // CST obrigatório
            $table->decimal('ibs_aliquota', 10, 4)->nullable();  // Alíquota se aplicável
            $table->boolean('ibs_isento')->default(false);  // Caso CST de isenção
            $table->boolean('ibs_doacao')->default(false);  // indDoacao

            $table->string('ibs_cclasstrib')->nullable();   // cClassTrib (opcional)

            $table->string('cbs_cst', 4)->nullable();
            $table->decimal('cbs_aliquota', 10, 4)->nullable();
            $table->boolean('cbs_isento')->default(false);
            $table->boolean('cbs_doacao')->default(false);
            $table->string('cbs_cclasstrib')->nullable();

            // Flags para casos especiais (NUNCA são preenchidos direto pelo usuário)
            $table->boolean('ibs_monofasico')->default(false);     // CST 620
            $table->boolean('ibs_transf_credito')->default(false); // CST 800
            $table->boolean('ibs_ajuste_compet')->default(false);  // CST 811
            $table->boolean('ibs_estorno')->default(false);
            $table->boolean('ibs_credito_presumido')->default(false);
            $table->boolean('ibs_credito_zfm')->default(false);
                    

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naturezas_operacao');
    }
};
