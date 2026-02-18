<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassificacaoTributariaSeeder extends Seeder
{
    public function run(): void
    {
        $classificacoes = [

            // 1️⃣ Venda tributada integralmente
            [
                'codigo' => null,
                'descricao' => 'Venda tributada integralmente',
                'tipo_operacao' => 'saida',
                'regime' => 'normal',

                'icms_incide' => true,
                'icms_st' => false,
                'icms_isento' => false,
                'icms_diferido' => false,
                'icms_monofasico' => false,
                'icms_reducao_bc' => false,
                'icms_gera_credito' => true,

                'pis_incide' => true,
                'pis_gera_credito' => true,

                'cofins_incide' => true,
                'cofins_gera_credito' => true,

                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 2️⃣ Venda isenta de ICMS
            [
                'codigo' => null,
                'descricao' => 'Venda isenta de ICMS',
                'tipo_operacao' => 'saida',
                'regime' => 'normal',

                'icms_incide' => false,
                'icms_isento' => true,
                'icms_st' => false,
                'icms_diferido' => false,
                'icms_monofasico' => false,
                'icms_reducao_bc' => false,
                'icms_gera_credito' => false,

                'pis_incide' => true,
                'pis_gera_credito' => false,

                'cofins_incide' => true,
                'cofins_gera_credito' => false,

                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 3️⃣ Venda com ICMS-ST
            [
                'codigo' => null,
                'descricao' => 'Venda com ICMS Substituição Tributária',
                'tipo_operacao' => 'saida',
                'regime' => 'normal',

                'icms_incide' => false,
                'icms_st' => true,
                'icms_isento' => false,
                'icms_diferido' => false,
                'icms_monofasico' => false,
                'icms_reducao_bc' => false,
                'icms_gera_credito' => false,

                'pis_incide' => true,
                'pis_gera_credito' => false,

                'cofins_incide' => true,
                'cofins_gera_credito' => false,

                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 4️⃣ Venda – Simples Nacional sem crédito
            [
                'codigo' => null,
                'descricao' => 'Venda – Simples Nacional sem crédito',
                'tipo_operacao' => 'saida',
                'regime' => 'simples',

                'icms_incide' => true,
                'icms_gera_credito' => false,

                'pis_incide' => false,
                'pis_gera_credito' => false,

                'cofins_incide' => false,
                'cofins_gera_credito' => false,

                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 5️⃣ Venda monofásica
            [
                'codigo' => null,
                'descricao' => 'Venda monofásica (tributo recolhido na origem)',
                'tipo_operacao' => 'saida',
                'regime' => 'ambos',

                'icms_monofasico' => true,
                'icms_incide' => false,
                'icms_gera_credito' => false,

                'pis_incide' => false,
                'pis_gera_credito' => false,

                'cofins_incide' => false,
                'cofins_gera_credito' => false,

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($classificacoes as $classificacao) {
            DB::table('classificacoes_tributarias')->updateOrInsert(
                ['descricao' => $classificacao['descricao']],
                $classificacao
            );
        }
    }
}
