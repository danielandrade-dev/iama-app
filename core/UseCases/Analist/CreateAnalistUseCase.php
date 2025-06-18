<?php

namespace core\UseCases\Analist;

use App\Models\Analist;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateAnalistUseCase
{
    public function handle(array $data): Analist
    {
        try {
            DB::beginTransaction();

            // Verificar se o usuário já é analista
            $existingAnalist = Analist::where('user_id', $data['user_id'])->first();
            if ($existingAnalist) {
                throw new Exception('Este usuário já é um analista.');
            }

            // Criar o analista
            $analist = Analist::create([
                'user_id' => $data['user_id'],
                'is_active' => $data['is_active'],
            ]);

            // Associar departamentos se fornecidos
            if ($data['department_ids']) {
                $departments = Department::whereIn('id', $data['department_ids'])->get();
                if ($departments->count() !== count($data['department_ids'])) {
                    throw new Exception('Alguns departamentos não foram encontrados.');
                }
                $analist->departments()->attach($data['department_ids']);
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
