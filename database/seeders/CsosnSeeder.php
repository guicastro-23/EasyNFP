<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CsosnSeeder extends Seeder
{
    public function run(): void
    {
        $csosns = [

            [
                'codigo' => '101',
                'descricao' => 'Tributada pelo Simples Nacional com permissão de crédito',
            ],
            [
                'codigo' => '102',
                'descricao' => 'Tributada pelo Simples Nacional sem permissão de crédito',
            ],
            [
                'codigo' => '103',
                'descricao' => 'Isenção do ICMS no Simples Nacional para faixa de receita bruta',
            ],
            [
                'codigo' => '201',
                'descricao' => 'Tributada pelo Simples Nacional com permissão de crédito e com cobrança do ICMS por substituição tributária',
            ],
            [
                'codigo' => '202',
                'descricao' => 'Tributada pelo Simples Nacional sem permissão de crédito e com cobrança do ICMS por substituição tributária',
            ],
            [
                'codigo' => '203',
                'descricao' => 'Isenção do ICMS no Simples Nacional para faixa de receita bruta e com cobrança do ICMS por substituição tributária',
            ],
            [
                'codigo' => '300',
                'descricao' => 'Imune',
            ],
            [
                'codigo' => '400',
                'descricao' => 'Não tributada pelo Simples Nacional',
            ],
            [
                'codigo' => '500',
                'descricao' => 'ICMS cobrado anteriormente por substituição tributária ou por antecipação',
            ],
            [
                'codigo' => '900',
                'descricao' => 'Outros',
            ],
        ];

        foreach ($csosns as $csosn) {
            DB::table('csosn')->updateOrInsert(
                ['codigo' => $csosn['codigo']],
                array_merge(
                    $csosn,
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ] 
                )
                
            );
        }
    }
}
