<?php

namespace App\Http\Controllers\Web;

use core\UseCases\Analist\PaginateAnalistUseCase;
use core\UseCases\Analist\FindAnalistUseCase;
use core\UseCases\Analist\CreateAnalistUseCase;
use core\UseCases\Analist\UpdateAnalistUseCase;
use core\Request\Analist\AnalistRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class AnalistController extends Controller
{

    /**
     * Listar analistas com paginação e filtros
     */
    public function paginate(Request $request, PaginateAnalistUseCase $useCase)
    {
        $filters = $request->validate([
            'per_page' => 'integer|min:1|max:100',
            'search' => 'string|max:255',
            'is_active' => 'boolean',
        ]);

        return Inertia::render('analists/index', [
            'analists' => $useCase->handle($filters)
        ]);
    }

    /**
     * Exibir analista específico
     */
    public function find(int $id, Request $request, FindAnalistUseCase $useCase)
    {
        return Inertia::render('analists/show', [
            'analist' => $useCase->handle($id)
        ]);
    }

    /**
     * Criar novo analista
     */
    public function create(AnalistRequest $request, CreateAnalistUseCase $useCase)
    {
        //$this->authorize('create', Analist::class);

        return $useCase->handle($request->validated());
    }

    /**
     * Atualizar analista
     */
    public function update(AnalistRequest $request, int $id, UpdateAnalistUseCase $useCase)
    {
        return $useCase->handle($id, $request->validated());
    }
}
