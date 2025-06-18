<?php

namespace core\UseCases\Analist;

use App\Models\Analist;
use Illuminate\Pagination\Paginator;

class PaginateAnalistUseCase
{
    public function handle(array $filters = []): Paginator
    {
        $perPage = $filters['per_page'] ?? 15;
        $search = $filters['search'] ?? null;
        $isActive = $filters['is_active'] ?? null;

        $query = Analist::query();

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        if ($isActive !== null) {
            $query->where('is_active', $isActive);
        }

        return $query->simplePaginate($perPage);
    }
}
