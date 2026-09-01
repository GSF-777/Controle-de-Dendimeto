<?php

namespace App\Http\Controllers;

use App\Services\PessoaService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PessoaController extends Controller
{
    public function __construct(
        private PessoaService $pessoaService
    ) {
    }

    public function index()
    {
        $pessoas = $this->pessoaService->listar();

        return Inertia::render('Pessoas/Index', [
            'pessoas' => $pessoas,
        ]);
    }

    public function create()
    {
        return Inertia::render('Pessoas/Create');
    }

    public function store(Request $request)
    {
        $this->pessoaService->criar(
            $request->all()
        );

        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa cadastrada com sucesso!');
    }

    public function show(int $id)
    {
        $pessoa = $this->pessoaService->buscarPorId($id);

        return Inertia::render('Pessoas/Show', [
            'pessoa' => $pessoa,
        ]);
    }

    public function edit(int $id)
    {
        $pessoa = $this->pessoaService->buscarPorId($id);

        return Inertia::render('Pessoas/Edit', [
            'pessoa' => $pessoa,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $this->pessoaService->atualizar(
            $id,
            $request->all()
        );

        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa atualizada com sucesso!');
    }

    public function destroy(int $id)
    {
        $this->pessoaService->excluir($id);

        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa removida com sucesso!');
    }
}
