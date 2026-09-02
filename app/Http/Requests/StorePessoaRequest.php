<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePessoaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'cpf' => [
                'required',
                'string',
                'max:14',
                'unique:pessoas,cpf',
            ],

            'telefone' => [
                'required',
                'string',
                'max:20',
            ],

            'tipo_atendimento' => [
                'required',
                Rule::in([
                    'Consulta',
                    'Exame',
                    'Emergência',
                    'Retorno',
                ]),
            ],

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
            'nome.required' =>
                'O nome é obrigatório.',

            'nome.min' =>
                'O nome deve ter pelo menos 3 caracteres.',

            'cpf.required' =>
                'O CPF é obrigatório.',

            'cpf.unique' =>
                'Este CPF já está cadastrado.',

            'telefone.required' =>
                'O telefone é obrigatório.',

            'tipo_atendimento.required' =>
                'Selecione o tipo de atendimento.',

            'tipo_atendimento.in' =>
                'O tipo de atendimento selecionado é inválido.',

            'cep.required' =>
                'O CEP é obrigatório.',

            'cep.size' =>
                'O CEP deve estar no formato 00000-000.',

            'logradouro.required' =>
                'O logradouro é obrigatório.',

            'numero.required' =>
                'O número é obrigatório.',

            'bairro.required' =>
                'O bairro é obrigatório.',

            'cidade.required' =>
                'A cidade é obrigatória.',

            'estado.required' =>
                'O estado é obrigatório.',

            'estado.size' =>
                'O estado deve possuir 2 caracteres.',
        ];
    }
}
