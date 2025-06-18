<?php

namespace core\DTOs\Analist;

class UpdateAnalistDTO
{
    public function __construct(
        public readonly ?bool $is_active = null,
        public readonly ?array $department_ids = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            is_active: $data['is_active'] ?? null,
            department_ids: $data['department_ids'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'is_active' => $this->is_active,
            'department_ids' => $this->department_ids,
        ], fn($value) => $value !== null);
    }

    public function hasChanges(): bool
    {
        return !empty($this->toArray());
    }
}
