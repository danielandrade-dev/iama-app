<?php

namespace Database\Factories;

use App\Models\Mesu;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'account' => $this->faker->unique()->numerify('ACC####'),
            'agency' => $this->faker->city(),
            'document' => $this->faker->unique()->numerify('##.###.###/####-##'),
            'mesu_id' => Mesu::factory(),
        ];
    }
}
