<?php

namespace core\DTOs\Analist;

class AnalistDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $user_id,
        public readonly bool $is_active,
        public readonly ?string $created_at = null,
        public readonly ?string $updated_at = null,
        public readonly ?string $deleted_at = null,
        // Relacionamentos
        public readonly ?array $user = null,
        public readonly ?array $departments = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            user_id: $data['user_id'],
            is_active: $data['is_active'] ?? true,
            created_at: $data['created_at'] ?? null,
            updated_at: $data['updated_at'] ?? null,
            deleted_at: $data['deleted_at'] ?? null,
            user: $data['user'] ?? null,
            departments: $data['departments'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'user' => $this->user,
            'departments' => $this->departments,
        ];
    }
}
