<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassificacaoCstIbsCbs extends Model
{
    use HasFactory;

    protected $table = 'classificacao_cst_ibscbs';

    protected $fillable = [
        'classificacao_tributaria_id',
        'cst_ibscbs_codigo',
        'tributo',
        'ativo',
    ];

    public function classificacao()
    {
        return $this->belongsTo(ClassificacaoTributaria::class, 'classificacao_tributaria_id');
    }

    public function cst()
    {
        return $this->belongsTo(CstIbsCbs::class, 'cst_ibscbs_codigo', 'codigo');
    }
}
