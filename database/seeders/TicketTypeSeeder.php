<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    public function run(): void
    {
        // Tipos principais (pais)
        $mainTypes = [
            'Hardware' => [
                'Impressora' => ['Tinta', 'Papel', 'Manutenção'],
                'Computador' => ['Sistema', 'Hardware', 'Software'],
                'Rede' => ['Conexão', 'Configuração', 'Segurança'],
            ],
            'Software' => [
                'Sistema Operacional' => ['Windows', 'Linux', 'Mac'],
                'Aplicativos' => ['Office', 'Navegador', 'Antivírus'],
                'Banco de Dados' => ['MySQL', 'PostgreSQL', 'Oracle'],
            ],
            'Infraestrutura' => [
                'Servidores' => ['Físico', 'Virtual', 'Cloud'],
                'Internet' => ['Conexão', 'Velocidade', 'Estabilidade'],
                'Backup' => ['Automático', 'Manual', 'Recuperação'],
            ],
        ];

        foreach ($mainTypes as $mainType => $subTypes) {
            $mainTypeId = TicketType::create(['name' => $mainType])->id;

            foreach ($subTypes as $subType => $subSubTypes) {
                $subTypeId = TicketType::create([
                    'name' => $subType,
                    'parent_id' => $mainTypeId
                ])->id;

                foreach ($subSubTypes as $subSubType) {
                    TicketType::create([
                        'name' => $subSubType,
                        'parent_id' => $subTypeId
                    ]);
                }
            }
        }
    }
}
