<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassificacaoCstIcms extends Model
{
    use HasFactory;

    protected $table = 'classificacao_cst_icms';

    protected $fillable = [
        'classificacao_tributaria_id',
        'cst_icms_codigo',
        'tipo_contribuinte',
        'ativo',
    ];

    public function classificacao()
    {
        return $this->belongsTo(ClassificacaoTributaria::class, 'classificacao_tributaria_id');
    }

    public function cst()
    {
        return $this->belongsTo(CstIcms::class, 'cst_icms_codigo', 'codigo');
    }
}
