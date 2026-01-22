<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NaturezaOperacao extends Model
{
    use HasFactory;

    protected $table = 'naturezas_operacao';

    protected $fillable = [
        'descricao',
        'natOp',
        'ativo',
        'tpNF',
        'finNFe',
        'idDest',
        'indFinal',
        'indPres',
        'cfop_codigo',
        'classificacao_tributaria_id',
    ];

    public function classificacaoTributaria()
    {
        return $this->belongsTo(
            ClassificacaoTributaria::class,
            'classificacao_tributaria_id'
        );
    }

    public function cfop()
    {
        return $this->belongsTo(Cfop::class, 'cfop_codigo', 'codigo');
    }
}
