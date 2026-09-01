<?php

namespace App\Services;

use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;

class PessoaService
{
    public function listar()
    {
        return Pessoa::with('endereco')
            ->latest()
            ->get();
    }

    public function buscarPorId(int $id)
    {
        return Pessoa::with('endereco')
            ->findOrFail($id);
    }

    public function criar(array $dados)
    {
        return DB::transaction(function () use ($dados) {

            $pessoa = Pessoa::create([
                'nome' => $dados['nome'],
                'cpf' => $dados['cpf'],
                'telefone' => $dados['telefone'],
                'tipo_atendimento' => $dados['tipo_atendimento'],
            ]);

            $pessoa->endereco()->create([
                'cep' => $dados['cep'],
                'logradouro' => $dados['logradouro'],
                'numero' => $dados['numero'],
                'complemento' => $dados['complemento'] ?? null,
                'bairro' => $dados['bairro'],
                'cidade' => $dados['cidade'],
                'estado' => $dados['estado'],
            ]);

            return $pessoa;
        });
    }

    public function atualizar(int $id, array $dados)
    {
        return DB::transaction(function () use ($id, $dados) {

            $pessoa = Pessoa::findOrFail($id);

            $pessoa->update([
                'nome' => $dados['nome'],
                'cpf' => $dados['cpf'],
                'telefone' => $dados['telefone'],
                'tipo_atendimento' => $dados['tipo_atendimento'],
            ]);

            $pessoa->endereco()->update([
                'cep' => $dados['cep'],
                'logradouro' => $dados['logradouro'],
                'numero' => $dados['numero'],
                'complemento' => $dados['complemento'] ?? null,
                'bairro' => $dados['bairro'],
                'cidade' => $dados['cidade'],
                'estado' => $dados['estado'],
            ]);

            return $pessoa;
        });
    }

    public function excluir(int $id)
    {
        $pessoa = Pessoa::findOrFail($id);

        return $pessoa->delete();
    }
}
