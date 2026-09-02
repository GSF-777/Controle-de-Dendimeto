<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePessoaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pessoaId = $this->route('id');

        return [
            // Pessoa
            'nome' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'cpf' => [
                'required',
                'string',
                Rule::unique('pessoas', 'cpf')->ignore($pessoaId),
            ],

            'telefone' => [
                'required',
                'string',
                'min:10',
                'max:20',
            ],

            'tipo_atendimento' => [
                'required',
                'string',
                Rule::in([
                    'Presencial',
                    'Telefone',
                    'Online',
                ]),
            ],

            // Endereço
            'cep' => [
                'required',
                'string',
                'size:9',
            ],

            'logradouro' => [
                'required',
                'string',
                'max:255',
            ],

            'numero' => [
                'required',
                'string',
                'max:10',
            ],

            'complemento' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bairro' => [
                'required',
                'string',
                'max:255',
            ],

            'cidade' => [
                'required',
                'string',
                'max:255',
            ],

            'estado' => [
                'required',
                'string',
                'size:2',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',

            'telefone.required' => 'O telefone é obrigatório.',

            'tipo_atendimento.required' => 'O tipo de atendimento é obrigatório.',
            'tipo_atendimento.in' => 'Tipo de atendimento inválido.',

            'cep.required' => 'O CEP é obrigatório.',
            'cep.size' => 'O CEP deve estar no formato 00000-000.',

            'logradouro.required' => 'O logradouro é obrigatório.',
            'numero.required' => 'O número é obrigatório.',
            'bairro.required' => 'O bairro é obrigatório.',
            'cidade.required' => 'A cidade é obrigatória.',

            'estado.required' => 'O estado é obrigatório.',
            'estado.size' => 'O estado deve possuir 2 caracteres.',
        ];
    }
}
