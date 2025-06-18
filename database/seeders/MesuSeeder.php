<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mesu;
use Illuminate\Database\Seeder;

class MesuSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuários para MESUs
        $users = User::factory(8)->create();

        // Criar MESUs principais (sem parent)
        $mainMesus = [];
        foreach (array_slice($users->toArray(), 0, 4) as $user) {
            $mainMesus[] = Mesu::create([
                'agency' => fake()->unique()->company(),
                'user_id' => $user['id'],
                'functional' => fake()->jobTitle(),
                'parent_mesu_id' => null,
                'is_active' => true,
            ]);
        }

        // Criar MESUs filhos (com parent)
        foreach (array_slice($users->toArray(), 4) as $user) {
            Mesu::create([
                'agency' => fake()->unique()->company(),
                'user_id' => $user['id'],
                'functional' => fake()->jobTitle(),
                'parent_mesu_id' => $mainMesus[array_rand($mainMesus)]->id,
                'is_active' => true,
            ]);
        }
    }
}
