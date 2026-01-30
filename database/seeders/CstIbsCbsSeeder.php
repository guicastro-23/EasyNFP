<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CstIbsCbsSeeder extends Seeder
{
    public function run(): void
    {
        $csts = [

            [
                'codigo' => '000',
                'descricao' => 'Tributação integral',
            ],
            [
                'codigo' => '040',
                'descricao' => 'Isenção',
            ],
            [
                'codigo' => '060',
                'descricao' => 'Imunidade',
            ],
            [
                'codigo' => '090',
                'descricao' => 'Suspensão',
            ],
            [
                'codigo' => '620',
                'descricao' => 'Tributação monofásica',
            ],
            [
                'codigo' => '800',
                'descricao' => 'Transferência de crédito',
            ],
            [
                'codigo' => '810',
                'descricao' => 'Ajuste de apuração',
            ],
            [
                'codigo' => '820',
                'descricao' => 'Estorno de crédito',
            ],
            [
                'codigo' => '900',
                'descricao' => 'Outras situações',
            ],
        ];

        foreach ($csts as $cst) {
            DB::table('cst_ibscbs')->updateOrInsert(
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
