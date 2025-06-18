<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinatario extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf',
        'cnpj',
        'id_estrangeiro',
        'xnome',
        'endereco_id',
        'ind_ie_dest',
        'ie',
        'isuf',
        'im',
        'email',
    ];

    /**
     * Relacionamento com o endereço
     */
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    /**
     * CPF ou CNPJ formatado
     */
    public function getDocumentoAttribute()
    {
        return $this->cnpj ?? $this->cpf ?? $this->id_estrangeiro;
    }
}
