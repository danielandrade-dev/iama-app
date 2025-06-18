<?php

namespace core\Request\Analist;

use Illuminate\Foundation\Http\FormRequest;

class AnalistRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'is_active' => 'boolean',
            'department_ids' => 'array',
            'department_ids.*' => 'integer|exists:departments,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'O campo usuário é obrigatório.',
            'user_id.integer' => 'O campo usuário deve ser um número inteiro.',
            'user_id.exists' => 'O usuário informado não existe.',
            'is_active.boolean' => 'O campo ativo deve ser um booleano.',
            'department_ids.array' => 'O campo departamentos deve ser um array.',
            'department_ids.*.integer' => 'O campo departamentos deve ser um número inteiro.',
            'department_ids.*.exists' => 'O departamento informado não existe.',
        ];
    }
}