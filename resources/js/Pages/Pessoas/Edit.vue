<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    pessoa: {
        type: Object,
        required: true,
    },
    endereco: {
        type: Object,
        default: null,
    },
})

const form = useForm({
    nome: props.pessoa.nome ?? '',
    cpf: props.pessoa.cpf ?? '',
    telefone: props.pessoa.telefone ?? '',
    tipo_atendimento: props.pessoa.tipo_atendimento ?? '',

    cep: props.endereco?.cep ?? '',
    logradouro: props.endereco?.logradouro ?? '',
    numero: props.endereco?.numero ?? '',
    complemento: props.endereco?.complemento ?? '',
    bairro: props.endereco?.bairro ?? '',
    cidade: props.endereco?.cidade ?? '',
    estado: props.endereco?.estado ?? '',
})

const submit = () => {
    form.put(route('pessoas.update', props.pessoa.id))
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="mx-auto max-w-4xl px-4">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Editar Pessoa
                </h1>

                <p class="mt-1 text-gray-600">
                    Atualize os dados da pessoa e do endereço.
                </p>
            </div>

            <form
                @submit.prevent="submit"
                class="space-y-6"
            >

                <!-- DADOS PESSOAIS -->
                <div class="rounded-lg bg-white p-6 shadow">

                    <h2 class="mb-5 text-xl font-semibold text-gray-800">
                        Dados pessoais
                    </h2>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        <!-- Nome -->
                        <div class="md:col-span-2">
                            <label
                                for="nome"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Nome
                            </label>

                            <input
                                id="nome"
                                v-model="form.nome"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />

                            <p
                                v-if="form.errors.nome"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.nome }}
                            </p>
                        </div>

                        <!-- CPF -->
                        <div>
                            <label
                                for="cpf"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                CPF
                            </label>

                            <input
                                id="cpf"
                                v-model="form.cpf"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />

                            <p
                                v-if="form.errors.cpf"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.cpf }}
                            </p>
                        </div>

                        <!-- Telefone -->
                        <div>
                            <label
                                for="telefone"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Telefone
                            </label>

                            <input
                                id="telefone"
                                v-model="form.telefone"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />

                            <p
                                v-if="form.errors.telefone"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.telefone }}
                            </p>
                        </div>

                        <!-- Tipo de atendimento -->
                        <div class="md:col-span-2">
                            <label
                                for="tipo_atendimento"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Tipo de atendimento
                            </label>

                            <select
                                id="tipo_atendimento"
                                v-model="form.tipo_atendimento"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="">
                                    Selecione
                                </option>

                                <option value="Consulta">
                                    Consulta
                                </option>

                                <option value="Cadastro">
                                    Cadastro
                                </option>

                                <option value="Atualização">
                                    Atualização
                                </option>
                            </select>

                            <p
                                v-if="form.errors.tipo_atendimento"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.tipo_atendimento }}
                            </p>
                        </div>

                    </div>
                </div>


                <!-- ENDEREÇO -->
                <div class="rounded-lg bg-white p-6 shadow">

                    <h2 class="mb-5 text-xl font-semibold text-gray-800">
                        Endereço
                    </h2>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        <!-- CEP -->
                        <div>
                            <label
                                for="cep"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                CEP
                            </label>

                            <input
                                id="cep"
                                v-model="form.cep"
                                type="text"
                                maxlength="9"
                                placeholder="00000-000"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />

                            <p
                                v-if="form.errors.cep"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.cep }}
                            </p>
                        </div>

                        <!-- Logradouro -->
                        <div>
                            <label
                                for="logradouro"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Logradouro
                            </label>

                            <input
                                id="logradouro"
                                v-model="form.logradouro"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />

                            <p
                                v-if="form.errors.logradouro"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.logradouro }}
                            </p>
                        </div>

                        <!-- Número -->
                        <div>
                            <label
                                for="numero"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Número
                            </label>

                            <input
                                id="numero"
                                v-model="form.numero"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />

                            <p
                                v-if="form.errors.numero"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.numero }}
                            </p>
                        </div>

                        <!-- Complemento -->
                        <div>
                            <label
                                for="complemento"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Complemento
                            </label>

                            <input
                                id="complemento"
                                v-model="form.complemento"
                                type="text"
                                placeholder="Apartamento, casa, sala..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />

                            <p
                                v-if="form.errors.complemento"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.complemento }}
                            </p>
                        </div>

                        <!-- Bairro -->
                        <div>
                            <label
                                for="bairro"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Bairro
                            </label>

                            <input
                                id="bairro"
                                v-model="form.bairro"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />

                            <p
                                v-if="form.errors.bairro"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.bairro }}
                            </p>
                        </div>

                        <!-- Cidade -->
                        <div>
                            <label
                                for="cidade"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Cidade
                            </label>

                            <input
                                id="cidade"
                                v-model="form.cidade"
                                type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />

                            <p
                                v-if="form.errors.cidade"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.cidade }}
                            </p>
                        </div>

                        <!-- Estado -->
                        <div>
                            <label
                                for="estado"
                                class="mb-1 block text-sm font-medium text-gray-700"
                            >
                                Estado
                            </label>

                            <select
                                id="estado"
                                v-model="form.estado"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="">
                                    Selecione
                                </option>

                                <option value="PI">Piauí</option>
                                <option value="MA">Maranhão</option>
                                <option value="CE">Ceará</option>
                                <option value="PE">Pernambuco</option>
                                <option value="BA">Bahia</option>
                            </select>

                            <p
                                v-if="form.errors.estado"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.estado }}
                            </p>
                        </div>

                    </div>
                </div>


                <!-- BOTÕES -->
                <div class="flex items-center justify-end gap-3">

                    <a
                        :href="route('pessoas.index')"
                        class="rounded-md bg-gray-200 px-5 py-2.5 font-medium text-gray-700 hover:bg-gray-300"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded-md bg-indigo-600 px-5 py-2.5 font-medium text-white hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        {{ form.processing ? 'Salvando...' : 'Salvar alterações' }}
                    </button>

                </div>

            </form>

        </div>
    </div>
</template>