<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassificacaoTributaria extends Model
{
    use HasFactory;

    protected $table = 'classificacoes_tributarias';

    protected $fillable = [
        'codigo',
        'descricao',
        'ativo',
        'tipo_operacao',
        'regime',

        // ICMS
        'icms_incide',
        'icms_st',
        'icms_isento',
        'icms_diferido',
        'icms_monofasico',
        'icms_reducao_bc',
        'icms_gera_credito',

        // PIS / COFINS
        'pis_incide',
        'pis_gera_credito',
        'cofins_incide',
        'cofins_gera_credito',

        // Crédito presumido
        'permite_credito_presumido',
        'credito_presumido_tipo',
        'credito_presumido_apropriacao',
        'credito_presumido_base_legal',

        // IBS / CBS
        'ibs_incide',
        'ibs_isento',
        'ibs_reducao',
        'gera_credito_ibs',
        'cbs_incide',
        'cbs_isento',
        'cbs_reducao',
        'gera_credito_cbs',

        // Técnicos
        'bloqueia_cst_manual',
        'exige_ibscbs_xml',
        'permite_valor_zero',
    ];

    /* =======================
     * RELACIONAMENTOS
     * ======================= */

    public function naturezas()
    {
        return $this->hasMany(NaturezaOperacao::class, 'classificacao_tributaria_id');
    }

    public function cstIcms()
    {
        return $this->hasMany(ClassificacaoCstIcms::class, 'classificacao_tributaria_id');
    }

    public function cstPis()
    {
        return $this->hasMany(ClassificacaoCstPis::class, 'classificacao_tributaria_id');
    }

    public function cstCofins()
    {
        return $this->hasMany(ClassificacaoCstCofins::class, 'classificacao_tributaria_id');
    }

    public function cstIbsCbs()
    {
        return $this->hasMany(ClassificacaoCstIbsCbs::class, 'classificacao_tributaria_id');
    }

    public function creditosPresumidos()
    {
        return $this->hasMany(ClassificacaoCreditoPresumido::class, 'classificacao_tributaria_id');
    }
}
