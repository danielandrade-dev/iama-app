<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Mesu;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar MESUs existentes
        $mesus = Mesu::all();

        if ($mesus->isEmpty()) {
            // Se não houver MESUs, criar alguns
            $mesus = Mesu::factory(3)->create();
        }

        // Criar clientes
        $clients = [
            ['name' => 'Empresa ABC Ltda', 'account' => 'ACC0001', 'agency' => 'São Paulo', 'document' => '12.345.678/0001-90'],
            ['name' => 'Comércio XYZ S.A.', 'account' => 'ACC0002', 'agency' => 'Rio de Janeiro', 'document' => '98.765.432/0001-10'],
            ['name' => 'Indústria 123 Ltda', 'account' => 'ACC0003', 'agency' => 'Belo Horizonte', 'document' => '11.222.333/0001-44'],
            ['name' => 'Serviços DEF Ltda', 'account' => 'ACC0004', 'agency' => 'Curitiba', 'document' => '55.666.777/0001-88'],
            ['name' => 'Comércio GHI Ltda', 'account' => 'ACC0005', 'agency' => 'Porto Alegre', 'document' => '99.000.111/0001-22'],
        ];

        foreach ($clients as $client) {
            Client::create([
                'name' => $client['name'],
                'account' => $client['account'],
                'agency' => $client['agency'],
                'document' => $client['document'],
                'mesu_id' => $mesus->random()->id,
            ]);
        }

        // Criar alguns clientes adicionais com factory
        Client::factory(10)->create();
    }
}
