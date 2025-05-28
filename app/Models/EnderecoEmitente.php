<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnderecoEmitente extends Model
{   

    protected $table = 'enderecos_emitente';
    protected $fillable = [
        'empresa_id',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'pais',
        'codigo_municipio',
        'codigo_pais',
    ];
   
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }


}
