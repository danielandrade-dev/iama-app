<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\TicketNote;
use App\Models\Tickets;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketNoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ticket_id' => Tickets::factory(),
            'user_id' => User::factory(),
            'content' => $this->faker->paragraphs(2, true),
            'attachments' => $this->faker->optional()->randomElements([
                'documento1.pdf',
                'imagem1.jpg',
                'relatorio.xlsx'
            ], $this->faker->numberBetween(0, 3)),
        ];
    }
}
