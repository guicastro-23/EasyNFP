<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassificacaoCreditoPresumido extends Model
{
    use HasFactory;

    protected $table = 'classificacao_credito_presumido';

    protected $fillable = [
        'classificacao_tributaria_id',
        'codigo',
        'descricao',
        'tributo',
        'percentual',
        'base_calculo',
        'apropriacao',
        'base_legal',
        'ativo',
    ];

    public function classificacao()
    {
        return $this->belongsTo(ClassificacaoTributaria::class, 'classificacao_tributaria_id');
    }
}
