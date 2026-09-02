<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { formatarCEP,formatarCPF, formatarTelefone } from '../../utils/formatacao'

const props = defineProps({
    pessoa: {
        type: Object,
        required: true,
    },
})

const form = useForm({
    nome: props.pessoa.nome ?? '',
    cpf: formatarCPF(props.pessoa.cpf ?? ''),
    telefone: formatarTelefone(props.pessoa.telefone ?? ''),
    tipo_atendimento: props.pessoa.tipo_atendimento ?? '',

    cep: formatarCEP(props.pessoa.endereco?.cep ?? ''),
    logradouro: props.pessoa.endereco?.logradouro ?? '',
    numero: props.pessoa.endereco?.numero ?? '',
    complemento: props.pessoa.endereco?.complemento ?? '',
    bairro: props.pessoa.endereco?.bairro ?? '',
    cidade: props.pessoa.endereco?.cidade ?? '',
    estado: props.pessoa.endereco?.estado ?? '',
})

const submit = () => {
    form.put(`/pessoas/${props.pessoa.id}`)
}
</script>

<template>
    <div class="pessoa-page">
        <div class="pessoa-container">

        <div class="pessoa-header">
            <h1>Editar Pessoa</h1>

            <p>
                Atualize os dados da pessoa e do endereço.
            </p>
        </div>

        <form
            @submit.prevent="submit"
            class="pessoa-form"
        >

            <!-- DADOS PESSOAIS -->
            <div class="pessoa-card">
                <h2>Dados pessoais</h2>

                <div class="pessoa-grid">

                    <!-- Nome -->
                    <div class="pessoa-field pessoa-field-full">
                        <label for="nome">
                            Nome
                        </label>

                        <input
                            id="nome"
                            v-model="form.nome"
                            type="text"
                        />

                        <p
                            v-if="form.errors.nome"
                            class="field-error"
                        >
                            {{ form.errors.nome }}
                        </p>
                    </div>

                    <!-- CPF -->
                    <div class="pessoa-field">
                        <label for="cpf">
                            CPF
                        </label>

                        <input
                            id="cpf"
                            @input="form.cpf = formatarCPF(form.cpf)"
                            v-model="form.cpf"
                            type="text"
                        />

                        <p
                            v-if="form.errors.cpf"
                            class="field-error"
                        >
                            {{ form.errors.cpf }}
                        </p>
                    </div>

                    <!-- Telefone -->
                    <div class="pessoa-field">
                        <label for="telefone">
                            Telefone
                        </label>

                        <input
                            id="telefone"
                            @input="form.telefone = formatarTelefone(form.telefone)"
                            v-model="form.telefone"
                            type="text"
                        />

                        <p
                            v-if="form.errors.telefone"
                            class="field-error"
                        >
                            {{ form.errors.telefone }}
                        </p>
                    </div>

                    <!-- Tipo de atendimento -->
                    <div class="pessoa-field pessoa-field-full">
                        <label for="tipo_atendimento">
                            Tipo de atendimento
                        </label>

                        <select
                            id="tipo_atendimento"
                            v-model="form.tipo_atendimento"
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
                            class="field-error"
                        >
                            {{ form.errors.tipo_atendimento }}
                        </p>
                    </div>

                </div>
            </div>

            <!-- ENDEREÇO -->
            <div class="pessoa-card">
                <h2>Endereço</h2>

                <div class="pessoa-grid">

                    <!-- CEP -->
                    <div class="pessoa-field">
                        <label for="cep">
                            CEP
                        </label>

                        <input
                            id="cep"
                            v-model="form.cep"
                            @input="form.cep = formatarCEP(form.cep)"
                            type="text"
                            maxlength="9"
                            placeholder="00000-000"
                        />

                        <p
                            v-if="form.errors.cep"
                            class="field-error"
                        >
                            {{ form.errors.cep }}
                        </p>
                    </div>

                    <!-- Logradouro -->
                    <div class="pessoa-field">
                        <label for="logradouro">
                            Logradouro
                        </label>

                        <input
                            id="logradouro"
                            v-model="form.logradouro"
                            type="text"
                        />

                        <p
                            v-if="form.errors.logradouro"
                            class="field-error"
                        >
                            {{ form.errors.logradouro }}
                        </p>
                    </div>

                    <!-- Número -->
                    <div class="pessoa-field">
                        <label for="numero">
                            Número
                        </label>

                        <input
                            id="numero"
                            v-model="form.numero"
                            type="text"
                        />

                        <p
                            v-if="form.errors.numero"
                            class="field-error"
                        >
                            {{ form.errors.numero }}
                        </p>
                    </div>

                    <!-- Complemento -->
                    <div class="pessoa-field">
                        <label for="complemento">
                            Complemento
                        </label>

                        <input
                            id="complemento"
                            v-model="form.complemento"
                            type="text"
                            placeholder="Apartamento, casa, sala..."
                        />

                        <p
                            v-if="form.errors.complemento"
                            class="field-error"
                        >
                            {{ form.errors.complemento }}
                        </p>
                    </div>

                    <!-- Bairro -->
                    <div class="pessoa-field">
                        <label for="bairro">
                            Bairro
                        </label>

                        <input
                            id="bairro"
                            v-model="form.bairro"
                            type="text"
                        />

                        <p
                            v-if="form.errors.bairro"
                            class="field-error"
                        >
                            {{ form.errors.bairro }}
                        </p>
                    </div>

                    <!-- Cidade -->
                    <div class="pessoa-field">
                        <label for="cidade">
                            Cidade
                        </label>

                        <input
                            id="cidade"
                            v-model="form.cidade"
                            type="text"
                        />

                        <p
                            v-if="form.errors.cidade"
                            class="field-error"
                        >
                            {{ form.errors.cidade }}
                        </p>
                    </div>

                    <!-- Estado -->
                    <div class="pessoa-field">
                        <label for="estado">
                            Estado
                        </label>

                        <select
                            id="estado"
                            v-model="form.estado"
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
                            class="field-error"
                        >
                            {{ form.errors.estado }}
                        </p>
                    </div>

                </div>
            </div>

            <!-- BOTÕES -->
            <div class="pessoa-actions">

                <Link
                    href="/pessoas"
                    class="btn btn-cancelar"
                >
                    Cancelar
                </Link>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="btn btn-salvar"
                >
                    {{ form.processing
                        ? 'Salvando...'
                        : 'Salvar alterações'
                    }}
                </button>

            </div>

        </form>

    </div>
</div>
```

</template>

<style>
/* =========================
PÁGINA
========================= */

.pessoa-page {
min-height: 100vh;
padding: 40px 20px;
background-color: #f5f7fb;
}

.pessoa-container {
width: 100%;
max-width: 1000px;
margin: 0 auto;
}

/* =========================
CABEÇALHO
========================= */

.pessoa-header {
margin-bottom: 30px;
}

.pessoa-header h1 {
margin-bottom: 8px;
font-size: 32px;
font-weight: 700;
color: #1f2937;
}

.pessoa-header p {
font-size: 16px;
color: #6b7280;
}

/* =========================
FORMULÁRIO
========================= */

.pessoa-form {
display: flex;
flex-direction: column;
gap: 24px;
}

/* =========================
CARDS
========================= */

.pessoa-card {
padding: 30px;
background-color: #ffffff;
border: 1px solid #e5e7eb;
border-radius: 12px;
box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.pessoa-card h2 {
margin-bottom: 25px;
font-size: 20px;
font-weight: 600;
color: #1f2937;
}

/* =========================
GRID
========================= */

.pessoa-grid {
display: grid;
grid-template-columns: repeat(2, 1fr);
gap: 20px;
}

.pessoa-field-full {
grid-column: 1 / -1;
}

/* =========================
CAMPOS
========================= */

.pessoa-field {
display: flex;
flex-direction: column;
}

.pessoa-field label {
margin-bottom: 8px;
font-size: 14px;
font-weight: 600;
color: #374151;
}

.pessoa-field input,
.pessoa-field select {
width: 100%;
padding: 12px 14px;


font-size: 15px;
color: #1f2937;

background-color: #ffffff;

border: 1px solid #d1d5db;
border-radius: 8px;

transition:
    border-color 0.2s ease,
    box-shadow 0.2s ease;

}

.pessoa-field input:focus,
.pessoa-field select:focus {
outline: none;
border-color: #4f46e5;
box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
}

.pessoa-field input::placeholder {
color: #9ca3af;
}

/* =========================
ERROS
========================= */

.field-error {
margin-top: 6px;
font-size: 13px;
color: #dc2626;
}

/* =========================
BOTÕES
========================= */

.pessoa-actions {
display: flex;
justify-content: flex-end;
gap: 12px;
}

.btn {
display: inline-flex;
align-items: center;
justify-content: center;

padding: 12px 22px;

border: none;
border-radius: 8px;

font-size: 15px;
font-weight: 600;

text-decoration: none;

cursor: pointer;

transition:
    background-color 0.2s ease,
    transform 0.15s ease,
    box-shadow 0.2s ease;

}

.btn:hover {
transform: translateY(-1px);
}

/* Cancelar */

.btn-cancelar {
color: #374151;
background-color: #e5e7eb;
}

.btn-cancelar:hover {
background-color: #d1d5db;
}

/* Salvar */

.btn-salvar {
color: #ffffff;
background-color: #4f46e5;
}

.btn-salvar:hover {
background-color: #4338ca;
box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
}

.btn-salvar:disabled {
cursor: not-allowed;
opacity: 0.6;
transform: none;
}

/* =========================
RESPONSIVIDADE
========================= */

@media (max-width: 768px) {

.pessoa-page {
    padding: 25px 15px;
}

.pessoa-header h1 {
    font-size: 26px;
}

.pessoa-card {
    padding: 20px;
}

.pessoa-grid {
    grid-template-columns: 1fr;
}

.pessoa-field-full {
    grid-column: auto;
}

.pessoa-actions {
    flex-direction: column-reverse;
}

.btn {
    width: 100%;
}

}
</style>
