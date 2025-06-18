<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Mesu;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        // Criar departamentos padrão
        $departments = [
            ['name' => 'Suporte Técnico', 'description' => 'Atendimento técnico e resolução de problemas'],
            ['name' => 'Vendas', 'description' => 'Gestão de vendas e relacionamento com clientes'],
            ['name' => 'Financeiro', 'description' => 'Controle financeiro e cobranças'],
            ['name' => 'RH', 'description' => 'Recursos humanos e gestão de pessoal'],
            ['name' => 'TI', 'description' => 'Tecnologia da informação e sistemas'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }

        // Criar alguns MESUs para associar aos departamentos
        $mesus = Mesu::factory(5)->create();

        // Associar MESUs aos departamentos
        foreach ($mesus as $mesu) {
            $mesu->departments()->attach(
                Department::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
