<?php

namespace Database\Factories;

use core\Enums\TransferStatus;
use core\Enums\TransferType;
use App\Models\Mesu;
use App\Models\Tickets;
use App\Models\TransferRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferRequestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'requester_mesu_id' => Mesu::factory(),
            'ceding_mesu_id' => Mesu::factory(),
            'transfer_type' => $this->faker->randomElement([
                TransferType::COMPANY_TO_RETAIL,
                TransferType::RETAIL_TO_COMPANY,
                TransferType::SAME_AGENCY,
                TransferType::COMPANY_TO_COMPANY
            ]),
            'status' => $this->faker->randomElement([
                TransferStatus::Pending,
                TransferStatus::Approved,
                TransferStatus::Rejected
            ]),
            'requester_approval_at' => null,
            'ceding_approval_at' => null,
            'requester_rejection_at' => null,
            'ceding_rejection_at' => null,
            'opening_observation' => $this->faker->optional()->paragraph(),
            'closing_observation' => null,
            'ticket_id' => Tickets::factory(),
        ];
    }
}
