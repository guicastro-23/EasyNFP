<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'xlgr',
        'nro',
        'xCpl',
        'xBairro',
        'cMun',
        'xMun',
        'UF',
        'CEP',
        'cPais',
        'xPais',
        'fone',
    ];

    /**
     * Relacionamento inverso com destinatário (um endereço pode pertencer a um destinatário)
     */
    public function destinatario()
    {
        return $this->hasOne(Destinatario::class);
    }
}
