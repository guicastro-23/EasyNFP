<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassificacaoCstCofins extends Model
{
    use HasFactory;

    protected $table = 'classificacao_cst_cofins';

    protected $fillable = [
        'classificacao_tributaria_id',
        'cst_cofins_codigo',
        'ativo',
    ];

    public function classificacao()
    {
        return $this->belongsTo(ClassificacaoTributaria::class, 'classificacao_tributaria_id');
    }

    public function cst()
    {
        return $this->belongsTo(CstCofins::class, 'cst_cofins_codigo', 'codigo');
    }
}
