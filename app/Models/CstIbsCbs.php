<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CstIbsCbs extends Model
{
    use HasFactory;

    protected $table = 'cst_ibscbs';

    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'codigo',
        'descricao',
    ];

    /**
     * Relação correta:
     * CST IBS/CBS ↔ Classificação Tributária (pivot)
     */
    public function classificacoes()
    {
        return $this->hasMany(
            ClassificacaoCstIbsCbs::class,
            'cst_ibscbs_codigo',
            'codigo'
        );
    }
}
