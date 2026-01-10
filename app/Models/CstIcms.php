<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CstIcms extends Model
{
    protected $table = 'cst_icms';

    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'codigo',
        'descricao',
    ];

    // Pessoa fisica com IE
    public function naturezasPfIe()
    {
        return $this->hasMany(
            NaturezaOperacao::class,
            'pf_ie_cst_icms',
            'codigo'
        );
    }

     // Pessoa Física sem IE
    public function naturezasPfNoIe()
    {
        return $this->hasMany(
            NaturezaOperacao::class,
            'pf_no_ie_cst_icms',
            'codigo'
        );
    }

    // Pessoa Jurídica com IE
    public function naturezasPjIe()
    {
        return $this->hasMany(
            NaturezaOperacao::class,
            'pj_ie_cst_icms',
            'codigo'
        );
    }

    // Pessoa Jurídica sem IE
    public function naturezasPjNoIe()
    {
        return $this->hasMany(
            NaturezaOperacao::class,
            'pj_no_ie_cst_icms',
            'codigo'
        );
    }
}
