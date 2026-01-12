<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaturezaOperacao extends Model
{
    protected $table = 'naturezas_operacao';

    protected $fillable = [
        // Informações gerais
        'descricao',
        'natOp',
        'tpNF',
        'finNFe',
        'idDest',
        'indFinal',
        'indPres',

        // ------------------------------------------------
        // PESSOA FÍSICA COM IE
        // ------------------------------------------------
        'pf_ie_cst_icms',
        'pf_ie_cst_pis',
        'pf_ie_cst_cofins',
        'pf_ie_cfop',

        // ------------------------------------------------
        // PESSOA FÍSICA SEM IE
        // ------------------------------------------------
        'pf_no_ie_cst_icms',
        'pf_no_ie_cst_pis',
        'pf_no_ie_cst_cofins',
        'pf_no_ie_cfop',

        // ------------------------------------------------
        // PESSOA JURÍDICA COM IE
        // ------------------------------------------------
        'pj_ie_cst_icms',
        'pj_ie_cst_pis',
        'pj_ie_cst_cofins',
        'pj_ie_cfop',

        // ------------------------------------------------
        // PESSOA JURÍDICA SEM IE
        // ------------------------------------------------
        'pj_no_ie_cst_icms',
        'pj_no_ie_cst_pis',
        'pj_no_ie_cst_cofins',
        'pj_no_ie_cfop',

        // ------------------------------------------------
        // SIMPLES NACIONAL (CSOSN)
        // ------------------------------------------------
        'pj_ie_csosn',
        'pj_no_ie_csosn',

        // ------------------------------------------------
        // IBS / CBS — Reforma Tributária
        // ------------------------------------------------
        'ibs_cst',
        'ibs_aliquota',
        'ibs_isento',
        'ibs_doacao',
        'ibs_cclasstrib',

        'cbs_cst',
        'cbs_aliquota',
        'cbs_isento',
        'cbs_doacao',
        'cbs_cclasstrib',

        // Flags especiais (uso interno)
        'ibs_monofasico',
        'ibs_transf_credito',
        'ibs_ajuste_compet',
        'ibs_estorno',
        'ibs_credito_presumido',
        'ibs_credito_zfm',
    ];

    /**
     * Casts automáticos
     */
    protected $casts = [
        'ibs_aliquota' => 'decimal:4',
        'cbs_aliquota' => 'decimal:4',

        'ibs_isento' => 'boolean',
        'ibs_doacao' => 'boolean',
        'cbs_isento' => 'boolean',
        'cbs_doacao' => 'boolean',

        'ibs_monofasico' => 'boolean',
        'ibs_transf_credito' => 'boolean',
        'ibs_ajuste_compet' => 'boolean',
        'ibs_estorno' => 'boolean',
        'ibs_credito_presumido' => 'boolean',
        'ibs_credito_zfm' => 'boolean',
    ];

    // ==================================================
    // RELACIONAMENTOS (CST / CFOP / CSOSN)
    // ==================================================

    public function pfIeCstIcms()
    {
        return $this->belongsTo(CstIcms::class, 'pf_ie_cst_icms', 'codigo');
    }

    public function pfIeCstPis()
    {
        return $this->belongsTo(CstPis::class, 'pf_ie_cst_pis', 'codigo');
    }

    public function pfIeCstCofins()
    {
        return $this->belongsTo(CstCofins::class, 'pf_ie_cst_cofins', 'codigo');
    }

    public function pjIeCfop()
    {
        return $this->belongsTo(Cfop::class, 'pj_ie_cfop', 'codigo');
    }

    public function pjIeCsosn()
    {
        return $this->belongsTo(Csosn::class, 'pj_ie_csosn', 'codigo');
    }

    
}
