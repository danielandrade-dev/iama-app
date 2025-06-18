<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Analist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Analist>
 */
class AnalistFactory extends Factory
{
    protected $model = \App\Models\Analist::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'is_active' => $this->faker->boolean(80), // 80% chance de ser ativo
        ];
    }
}
