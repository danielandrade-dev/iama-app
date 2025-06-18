<?php

namespace Database\Factories;

use App\Models\User;
use core\Enums\Priority;
use core\Enums\Status;
use App\Models\Analist;
use App\Models\Department;
use App\Models\TicketType;
use App\Models\Tickets;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ticket_type_id' => TicketType::factory(),
            'status_id' => Status::ABERTO,
            'priority_id' => $this->faker->randomElement([Priority::Alta, Priority::Media, Priority::Baixa]),
            'department_id' => Department::factory(),
            'analyst_id' => null,
            'created_by' => User::factory(),
            'closed_by' => null,
            'opening_observation' => $this->faker->optional()->paragraph(),
            'closing_observation' => null,
            'closed_at' => null,
        ];
    }

    /**
     * Ticket em atendimento (com analista)
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'analyst_id' => Analist::factory(),
            'status_id' => Status::ATENDIMENTO,
        ]);
    }

    /**
     * Ticket fechado (concluído)
     */
    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'analyst_id' => Analist::factory(),
            'status_id' => Status::FECHADO,
            'closed_by' => User::factory(),
            'closed_at' => now(),
        ]);
    }

    /**
     * Ticket rejeitado (cancelado)
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status_id' => Status::REJEITADO,
            'closed_by' => User::factory(),
            'closed_at' => now(),
        ]);
    }
}
