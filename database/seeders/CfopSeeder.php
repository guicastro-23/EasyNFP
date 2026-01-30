<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CfopSeeder extends Seeder
{
    public function run(): void
    {
        $cfops = [

            // ----------------------------
            // SAÍDAS - DENTRO DO ESTADO
            // ----------------------------
            [
                'codigo' => '5101',
                'descricao' => 'Venda de produção do estabelecimento',
                'tipo' => 'saida',
            ],
            [
                'codigo' => '5102',
                'descricao' => 'Venda de mercadoria adquirida ou recebida de terceiros',
                'tipo' => 'saida',
            ],
            [
                'codigo' => '5401',
                'descricao' => 'Venda de produção do estabelecimento sujeita a substituição tributária',
                'tipo' => 'saida',
            ],
            [
                'codigo' => '5405',
                'descricao' => 'Venda de mercadoria adquirida ou recebida de terceiros sujeita a substituição tributária',
                'tipo' => 'saida',
            ],
            [
                'codigo' => '5910',
                'descricao' => 'Remessa em bonificação, doação ou brinde',
                'tipo' => 'saida',
            ],
            [
                'codigo' => '5949',
                'descricao' => 'Outra saída de mercadoria ou prestação de serviço não especificado',
                'tipo' => 'saida',
            ],

            // ----------------------------
            // SAÍDAS - INTERESTADUAL
            // ----------------------------
            [
                'codigo' => '6101',
                'descricao' => 'Venda de produção do estabelecimento',
                'tipo' => 'saida',
            ],
            [
                'codigo' => '6102',
                'descricao' => 'Venda de mercadoria adquirida ou recebida de terceiros',
                'tipo' => 'saida',
            ],
            [
                'codigo' => '6401',
                'descricao' => 'Venda de produção do estabelecimento sujeita a substituição tributária',
                'tipo' => 'saida',
            ],
            [
                'codigo' => '6404',
                'descricao' => 'Venda de mercadoria adquirida ou recebida de terceiros sujeita a substituição tributária',
                'tipo' => 'saida',
            ],
            [
                'codigo' => '6949',
                'descricao' => 'Outra saída de mercadoria ou prestação de serviço não especificado',
                'tipo' => 'saida',
            ],

            // ----------------------------
            // ENTRADAS - DENTRO DO ESTADO
            // ----------------------------
            [
                'codigo' => '1101',
                'descricao' => 'Compra para industrialização',
                'tipo' => 'entrada',
            ],
            [
                'codigo' => '1102',
                'descricao' => 'Compra para comercialização',
                'tipo' => 'entrada',
            ],
            [
                'codigo' => '1201',
                'descricao' => 'Devolução de venda de produção do estabelecimento',
                'tipo' => 'entrada',
            ],
            [
                'codigo' => '1202',
                'descricao' => 'Devolução de venda de mercadoria adquirida ou recebida de terceiros',
                'tipo' => 'entrada',
            ],
            [
                'codigo' => '1401',
                'descricao' => 'Compra de produção do estabelecimento sujeita a substituição tributária',
                'tipo' => 'entrada',
            ],
            [
                'codigo' => '1556',
                'descricao' => 'Compra de material para uso ou consumo',
                'tipo' => 'entrada',
            ],

            // ----------------------------
            // ENTRADAS - INTERESTADUAL
            // ----------------------------
            [
                'codigo' => '2101',
                'descricao' => 'Compra para industrialização',
                'tipo' => 'entrada',
            ],
            [
                'codigo' => '2102',
                'descricao' => 'Compra para comercialização',
                'tipo' => 'entrada',
            ],
            [
                'codigo' => '2201',
                'descricao' => 'Devolução de venda de produção do estabelecimento',
                'tipo' => 'entrada',
            ],
            [
                'codigo' => '2202',
                'descricao' => 'Devolução de venda de mercadoria adquirida ou recebida de terceiros',
                'tipo' => 'entrada',
            ],
            [
                'codigo' => '2401',
                'descricao' => 'Compra sujeita a substituição tributária',
                'tipo' => 'entrada',
            ],
            [
                'codigo' => '2556',
                'descricao' => 'Compra de material para uso ou consumo',
                'tipo' => 'entrada',
            ],
        ];

        foreach ($cfops as $cfop) {
            DB::table('cfops')->updateOrInsert(
                ['codigo' => $cfop['codigo']],
                array_merge(
                    $cfop,
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ] 
                )
                
            );
        }
    }
}
