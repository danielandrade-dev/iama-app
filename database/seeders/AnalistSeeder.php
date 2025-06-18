<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Analist;
use App\Models\Department;
use Illuminate\Database\Seeder;

class AnalistSeeder extends Seeder
{
    public function run(): void
    {
        // Criar alguns usuários para analistas
        $users = User::factory(5)->create();

        // Criar analistas
        $analists = [];
        foreach ($users as $user) {
            $analists[] = Analist::factory()->create([
                'user_id' => $user->id,
                'is_active' => true,
            ]);
        }

        // Criar departamentos
        $departments = Department::factory(3)->create();

        // Associar analistas aos departamentos
        foreach ($analists as $analist) {
            $analist->departments()->attach(
                $departments->random(rand(1, 2))->pluck('id')->toArray()
            );
        }
    }
}
