<?php

namespace core\DTOs\Analist;

class CreateAnalistDTO
{
    public function __construct(
        public readonly int $user_id,
        public readonly bool $is_active = true,
        public readonly ?array $department_ids = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            is_active: $data['is_active'] ?? true,
            department_ids: $data['department_ids'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
            'department_ids' => $this->department_ids,
        ];
    }
}
