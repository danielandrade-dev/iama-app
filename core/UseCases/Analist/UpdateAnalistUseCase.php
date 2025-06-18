<?php

namespace core\UseCases\Analist;

use core\DTOs\Analist\UpdateAnalistDTO;
use core\DTOs\Analist\AnalistDTO;
use App\Models\Analist;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateAnalistUseCase
{
    public function handle(int $analistId, array $data): Analist
    {
        try {
            DB::beginTransaction();

            $analist = Analist::findOrFail($analistId);

            // Atualizar campos básicos
            if ($data['is_active'] !== null) {
                $analist->is_active = $data['is_active'];
            }

            $analist->save();

            // Atualizar departamentos se fornecidos
            if ($data['department_ids'] !== null) {
                if (empty($data['department_ids'])) {
                    // Remover todos os departamentos
                    $analist->departments()->detach();
                } else {
                    // Verificar se todos os departamentos existem
                    $departments = Department::whereIn('id', $data['department_ids'])->get();
                    if ($departments->count() !== count($data['department_ids'])) {
                        throw new Exception('Alguns departamentos não foram encontrados.');
                    }

                    // Sincronizar departamentos
                    $analist->departments()->sync($data['department_ids']);
                }
            }

            DB::commit();

            // Carregar relacionamentos
            $analist->load(['user', 'departments']);

            return $analist;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
