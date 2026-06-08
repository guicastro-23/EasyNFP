<?php

namespace App\Domain\Fiscal;

use Exception;

class IcmsCalculator
{
    public function calcular(float $valor, ?string $cst): array
    {
        if ($cst !== '00') {
            throw new Exception('Somente ICMS CST 00 implementado inicialmente.');
        }

        $aliquota = 18.00;
        $base = $valor;

        return [
            'cst' => $cst,
            'base' => $base,
            'aliquota' => $aliquota,
            'valor' => round($base * ($aliquota / 100), 2),
        ];
    }
}