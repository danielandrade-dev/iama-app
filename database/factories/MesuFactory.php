<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Mesu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MesuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'agency' => $this->faker->unique()->company(),
            'user_id' => User::factory(),
            'functional' => $this->faker->jobTitle(),
            'parent_mesu_id' => null, // Será definido no seeder se necessário
            'is_active' => $this->faker->boolean(90), // 90% chance de ser ativo
        ];
    }
}
