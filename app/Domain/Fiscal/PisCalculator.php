<?php

namespace App\Domain\Fiscal;

use Exception;

class PisCalculator
{
    public function calcular(float $valor, ?string $cst): array
    {
        if ($cst !== '01') {
            throw new Exception('Somente PIS CST 01 implementado inicialmente.');
        }

        $aliquota = 1.65;

        return [
            'cst' => $cst,
            'base' => $valor,
            'aliquota' => $aliquota,
            'valor' => round($valor * ($aliquota / 100), 2),
        ];
    }
}