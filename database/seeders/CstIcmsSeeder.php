<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CstIcmsSeeder extends Seeder
{
    public function run(): void
    {
        $csts = [

            [
                'codigo' => '00',
                'descricao' => 'Tributada integralmente',
            ],
            [
                'codigo' => '10',
                'descricao' => 'Tributada e com cobrança do ICMS por substituição tributária',
            ],
            [
                'codigo' => '20',
                'descricao' => 'Tributada com redução de base de cálculo',
            ],
            [
                'codigo' => '30',
                'descricao' => 'Isenta ou não tributada e com cobrança do ICMS por substituição tributária',
            ],
            [
                'codigo' => '40',
                'descricao' => 'Isenta',
            ],
            [
                'codigo' => '41',
                'descricao' => 'Não tributada',
            ],
            [
                'codigo' => '50',
                'descricao' => 'Suspensão',
            ],
            [
                'codigo' => '51',
                'descricao' => 'Diferimento',
            ],
            [
                'codigo' => '60',
                'descricao' => 'ICMS cobrado anteriormente por substituição tributária',
            ],
            [
                'codigo' => '70',
                'descricao' => 'Tributada com redução de base de cálculo e cobrança do ICMS por substituição tributária',
            ],
            [
                'codigo' => '90',
                'descricao' => 'Outros',
            ],
        ];

        foreach ($csts as $cst) {
            DB::table('cst_icms')->updateOrInsert(
                ['codigo' => $cst['codigo']],
                array_merge(
                    $cst,
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                )
            );
        }
    }
}
