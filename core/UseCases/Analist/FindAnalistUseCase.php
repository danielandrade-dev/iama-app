<?php

namespace core\UseCases\Analist;

use App\Models\Analist;
use Exception;

class FindAnalistUseCase
{
    public function handle(int $analistId, array $with = ['user', 'departments']): Analist
    {
        $analist = Analist::with($with)->find($analistId);

        if (!$analist) {
            throw new Exception('Analista não encontrado.');
        }

        return $analist;
    }
}
