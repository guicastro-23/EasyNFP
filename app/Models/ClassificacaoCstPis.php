<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassificacaoCstPis extends Model
{
    use HasFactory;

    protected $table = 'classificacao_cst_pis';

    protected $fillable = [
        'classificacao_tributaria_id',
        'cst_pis_codigo',
        'ativo',
    ];

    public function classificacao()
    {
        return $this->belongsTo(ClassificacaoTributaria::class, 'classificacao_tributaria_id');
    }

    public function cst()
    {
        return $this->belongsTo(CstPis::class, 'cst_pis_codigo', 'codigo');
    }
}
