<?php

namespace App\Domain\Fiscal;

use Exception;

class CofinsCalculator
{
    public function calcular(float $valor, ?string $cst): array
    {
        if ($cst !== '01') {
            throw new Exception('Somente COFINS CST 01 implementado inicialmente.');
        }

        $aliquota = 7.60;

        return [
            'cst' => $cst,
            'base' => $valor,
            'aliquota' => $aliquota,
            'valor' => round($valor * ($aliquota / 100), 2),
        ];
    }
}