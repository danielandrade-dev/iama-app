<?php

namespace Database\Factories;

use core\Enums\TemplateType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->slug(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'type' => $this->faker->randomElement([TemplateType::Notification, TemplateType::Email]),
        ];
    }
}
