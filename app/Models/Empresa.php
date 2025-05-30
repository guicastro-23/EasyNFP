<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
        use HasFactory;
        protected $fillable = [
        'tipo_pessoa',
        'cpf_cnpj',
        'nome_razao_social',
        'nome_fantasia',
        'inscricao_estadual',
        'inscricao_municipal',
        'fone',
        'email',
        'ambiente'
        ];

       public function endereco()
        {
                return $this->hasOne(EnderecoEmitente::class, 'empresa_id', 'id');
        }

}
