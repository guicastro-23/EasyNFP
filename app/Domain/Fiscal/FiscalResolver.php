<?php

namespace App\Domain\Fiscal;

use App\Models\NaturezaOperacao;
use App\Models\Produto;
use Exception;

class FiscalResolver
{
    public function resolver(Produto $produto, NaturezaOperacao $natureza, float $valor): array
    {
        $classificacao = $natureza->classificacaoTributaria;

        if (!$classificacao) {
            throw new Exception('Natureza sem classificação tributária.');
        }

        if ($classificacao->descricao !== 'Venda tributada integralmente') {
            throw new Exception('Cenário fiscal ainda não implementado.');
        }

        $cstIcms = $classificacao->cstsIcms()->first()?->cst_icms_codigo;
        $cstPis = $classificacao->cstsPis()->first()?->cst_pis_codigo;
        $cstCofins = $classificacao->cstsCofins()->first()?->cst_cofins_codigo;

        return [
            'cfop' => $natureza->cfop_codigo,
            'produto' => [
                'id' => $produto->id,
                'orig' => $produto->orig ?? 0,
                'valor' => $valor,
            ],
            'icms' => (new IcmsCalculator())->calcular($valor, $cstIcms),
            'pis' => (new PisCalculator())->calcular($valor, $cstPis),
            'cofins' => (new CofinsCalculator())->calcular($valor, $cstCofins),
        ];
    }
}