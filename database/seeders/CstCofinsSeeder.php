<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CstCofinsSeeder extends Seeder
{
    public function run(): void
    {
        $csts = [

            [
                'codigo' => '01',
                'descricao' => 'Operação tributável com alíquota básica',
            ],
            [
                'codigo' => '02',
                'descricao' => 'Operação tributável com alíquota diferenciada',
            ],
            [
                'codigo' => '03',
                'descricao' => 'Operação tributável com alíquota por unidade de medida de produto',
            ],
            [
                'codigo' => '04',
                'descricao' => 'Operação tributável monofásica – revenda a alíquota zero',
            ],
            [
                'codigo' => '05',
                'descricao' => 'Operação tributável por substituição tributária',
            ],
            [
                'codigo' => '06',
                'descricao' => 'Operação tributável a alíquota zero',
            ],
            [
                'codigo' => '07',
                'descricao' => 'Operação isenta da contribuição',
            ],
            [
                'codigo' => '08',
                'descricao' => 'Operação sem incidência da contribuição',
            ],
            [
                'codigo' => '09',
                'descricao' => 'Operação com suspensão da contribuição',
            ],
            [
                'codigo' => '49',
                'descricao' => 'Outras operações de saída',
            ],
            [
                'codigo' => '50',
                'descricao' => 'Operação com direito a crédito – vinculada exclusivamente a receita tributada no mercado interno',
            ],
            [
                'codigo' => '51',
                'descricao' => 'Operação com direito a crédito – vinculada exclusivamente a receita não tributada no mercado interno',
            ],
            [
                'codigo' => '52',
                'descricao' => 'Operação com direito a crédito – vinculada exclusivamente a receita de exportação',
            ],
            [
                'codigo' => '53',
                'descricao' => 'Operação com direito a crédito – vinculada a receitas tributadas e não tributadas no mercado interno',
            ],
            [
                'codigo' => '54',
                'descricao' => 'Operação com direito a crédito – vinculada a receitas tributadas no mercado interno e de exportação',
            ],
            [
                'codigo' => '55',
                'descricao' => 'Operação com direito a crédito – vinculada a receitas não tributadas no mercado interno e de exportação',
            ],
            [
                'codigo' => '56',
                'descricao' => 'Operação com direito a crédito – vinculada a receitas tributadas e não tributadas no mercado interno e de exportação',
            ],
            [
                'codigo' => '99',
                'descricao' => 'Outras operações',
            ],
        ];

        foreach ($csts as $cst) {
            DB::table('cst_cofins')->updateOrInsert(
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
