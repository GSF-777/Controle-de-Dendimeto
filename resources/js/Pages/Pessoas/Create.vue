<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { computed, nextTick } from 'vue';

import {
    formatarCPF,
    formatarTelefone,
    formatarCEP,
} from '../../utils/formatacao.js';

import {
    validarNome,
    validarCPF,
    validarTelefone,
    validarCEP,
} from '../../utils/validator.js';

import AppLayout from '../layouts/layouts.vue';

const form = useForm({
    nome: '',
    cpf: '',
    telefone: '',
    tipo_atendimento: '',

    cep: '',
    logradouro: '',
    numero: '',
    complemento: '',
    bairro: '',
    cidade: '',
    estado: '',
});

/*
|--------------------------------------------------------------------------
| Validações locais
|--------------------------------------------------------------------------
*/

const errosLocais = computed(() => ({
    nome: validarNome(form.nome),
    cpf: validarCPF(form.cpf),
    telefone: validarTelefone(form.telefone),
    cep: validarCEP(form.cep),

    tipo_atendimento:
        !form.tipo_atendimento
            ? 'Selecione o tipo de atendimento.'
            : '',

    logradouro:
        !form.logradouro.trim()
            ? 'O logradouro é obrigatório.'
            : '',

    numero:
        !form.numero.trim()
            ? 'O número é obrigatório.'
            : '',

    bairro:
        !form.bairro.trim()
            ? 'O bairro é obrigatório.'
            : '',

    cidade:
        !form.cidade.trim()
            ? 'A cidade é obrigatória.'
            : '',

    estado:
        !form.estado
            ? 'Selecione o estado.'
            : '',
}));

/*
|--------------------------------------------------------------------------
| Erro final do campo
|--------------------------------------------------------------------------
|
| Primeiro verifica o erro retornado pelo Laravel.
| Se não existir, usa a validação local.
|
*/

const erroCampo = (campo) => {
    return form.errors[campo] || errosLocais.value[campo] || '';
};

/*
|--------------------------------------------------------------------------
| Verifica se o formulário possui erros locais
|--------------------------------------------------------------------------
*/

const formularioValido = computed(() => {
    return Object.values(errosLocais.value).every(
        (erro) => !erro
    );
});

/*
|--------------------------------------------------------------------------
| Submit
|--------------------------------------------------------------------------
*/

const cadastrar = async () => {
    /*
     * Não envia se houver erro de validação local.
     */
    if (!formularioValido.value) {
        await nextTick();

        const primeiroErro = document.querySelector(
            '.field.has-error input, .field.has-error select'
        );

        primeiroErro?.focus();

        return;
    }

    /*
     * Limpa os erros antigos do Laravel.
     */
    form.clearErrors();

    form.post('/pessoas', {
        preserveScroll: true,

        onSuccess: () => {
            form.reset();
        },

        onError: async () => {
            /*
             * Depois que o Laravel retornar os erros,
             * foca no primeiro campo com problema.
             */
            await nextTick();

            const primeiroErro = document.querySelector(
                '.field.has-error input, .field.has-error select'
            );

            primeiroErro?.focus();
        },
    });
};

/*
|--------------------------------------------------------------------------
| Estados brasileiros
|--------------------------------------------------------------------------
*/

const estados = [
    { sigla: 'AC', nome: 'Acre' },
    { sigla: 'AL', nome: 'Alagoas' },
    { sigla: 'AP', nome: 'Amapá' },
    { sigla: 'AM', nome: 'Amazonas' },
    { sigla: 'BA', nome: 'Bahia' },
    { sigla: 'CE', nome: 'Ceará' },
    { sigla: 'DF', nome: 'Distrito Federal' },
    { sigla: 'ES', nome: 'Espírito Santo' },
    { sigla: 'GO', nome: 'Goiás' },
    { sigla: 'MA', nome: 'Maranhão' },
    { sigla: 'MT', nome: 'Mato Grosso' },
    { sigla: 'MS', nome: 'Mato Grosso do Sul' },
    { sigla: 'MG', nome: 'Minas Gerais' },
    { sigla: 'PA', nome: 'Pará' },
    { sigla: 'PB', nome: 'Paraíba' },
    { sigla: 'PR', nome: 'Paraná' },
    { sigla: 'PE', nome: 'Pernambuco' },
    { sigla: 'PI', nome: 'Piauí' },
    { sigla: 'RJ', nome: 'Rio de Janeiro' },
    { sigla: 'RN', nome: 'Rio Grande do Norte' },
    { sigla: 'RS', nome: 'Rio Grande do Sul' },
    { sigla: 'RO', nome: 'Rondônia' },
    { sigla: 'RR', nome: 'Roraima' },
    { sigla: 'SC', nome: 'Santa Catarina' },
    { sigla: 'SP', nome: 'São Paulo' },
    { sigla: 'SE', nome: 'Sergipe' },
    { sigla: 'TO', nome: 'Tocantins' },
];
</script>

<template>
    <AppLayout>

        <div class="page">

            <!-- ==========================================
                 CABEÇALHO
            =========================================== -->

            <header class="page-header">

                <div class="header-content">

                    <div class="breadcrumb">
                        <Link href="/pessoas">
                            Pessoas
                        </Link>

                        <span>/</span>

                        <span>Novo cadastro</span>
                    </div>

                    <h1>Cadastrar pessoa</h1>

                    <p>
                        Preencha os dados abaixo para realizar
                        o cadastro.
                    </p>

                </div>

            </header>

            <!-- ==========================================
                 FORMULÁRIO
            =========================================== -->

            <form
                @submit.prevent="cadastrar"
                class="form"
                novalidate
            >

                <!-- ======================================
                     DADOS PESSOAIS
                ======================================= -->

                <section class="section">

                    <div class="section-header">

                        <div class="section-icon blue">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    d="M20 21a8 8 0 0 0-16 0"
                                />
                                <circle
                                    cx="12"
                                    cy="7"
                                    r="4"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2>Dados pessoais</h2>

                            <p>
                                Informações básicas da pessoa.
                            </p>
                        </div>

                    </div>

                    <div class="divider"></div>

                    <div class="grid">

                        <!-- NOME -->
                        <div
                            class="field field-full"
                            :class="{
                                'has-error': erroCampo('nome'),
                            }"
                        >
                            <label for="nome">
                                Nome completo

                                <span class="required">
                                    *
                                </span>
                            </label>

                            <input
                                id="nome"
                                v-model="form.nome"
                                type="text"
                                placeholder="Digite o nome completo"
                                autocomplete="name"
                                maxlength="255"
                                :aria-invalid="!!erroCampo('nome')"
                                :aria-describedby="
                                    erroCampo('nome')
                                        ? 'erro-nome'
                                        : undefined
                                "
                            />

                            <span
                                v-if="erroCampo('nome')"
                                id="erro-nome"
                                class="error"
                            >
                                {{ erroCampo('nome') }}
                            </span>
                        </div>

                        <!-- CPF -->
                        <div
                            class="field"
                            :class="{
                                'has-error': erroCampo('cpf'),
                            }"
                        >
                            <label for="cpf">
                                CPF

                                <span class="required">
                                    *
                                </span>
                            </label>

                            <input
                                id="cpf"
                                v-model="form.cpf"
                                @input="
                                    form.cpf =
                                        formatarCPF(form.cpf)
                                "
                                type="text"
                                inputmode="numeric"
                                placeholder="000.000.000-00"
                                autocomplete="off"
                                maxlength="14"
                                :aria-invalid="!!erroCampo('cpf')"
                            />

                            <span
                                v-if="erroCampo('cpf')"
                                class="error"
                            >
                                {{ erroCampo('cpf') }}
                            </span>
                        </div>

                        <!-- TELEFONE -->
                        <div
                            class="field"
                            :class="{
                                'has-error':
                                    erroCampo('telefone'),
                            }"
                        >
                            <label for="telefone">
                                Telefone

                                <span class="required">
                                    *
                                </span>
                            </label>

                            <input
                                id="telefone"
                                v-model="form.telefone"
                                @input="
                                    form.telefone =
                                        formatarTelefone(
                                            form.telefone
                                        )
                                "
                                type="tel"
                                inputmode="tel"
                                placeholder="(00) 00000-0000"
                                autocomplete="tel"
                                maxlength="15"
                                :aria-invalid="
                                    !!erroCampo('telefone')
                                "
                            />

                            <span
                                v-if="erroCampo('telefone')"
                                class="error"
                            >
                                {{ erroCampo('telefone') }}
                            </span>
                        </div>

                        <!-- TIPO DE ATENDIMENTO -->
                        <div
                            class="field"
                            :class="{
                                'has-error':
                                    erroCampo(
                                        'tipo_atendimento'
                                    ),
                            }"
                        >
                            <label for="tipo_atendimento">
                                Tipo de atendimento

                                <span class="required">
                                    *
                                </span>
                            </label>

                            <select
                                id="tipo_atendimento"
                                v-model="
                                    form.tipo_atendimento
                                "
                                :aria-invalid="
                                    !!erroCampo(
                                        'tipo_atendimento'
                                    )
                                "
                            >
                                <option value="" disabled>
                                    Selecione o atendimento
                                </option>

                                <option value="Consulta">
                                    Consulta
                                </option>

                                <option value="Exame">
                                    Exame
                                </option>

                                <option value="Emergência">
                                    Emergência
                                </option>

                                <option value="Retorno">
                                    Retorno
                                </option>
                            </select>

                            <span
                                v-if="
                                    erroCampo(
                                        'tipo_atendimento'
                                    )
                                "
                                class="error"
                            >
                                {{
                                    erroCampo(
                                        'tipo_atendimento'
                                    )
                                }}
                            </span>
                        </div>

                    </div>

                </section>

                <!-- ======================================
                     ENDEREÇO
                ======================================= -->

                <section class="section">

                    <div class="section-header">

                        <div class="section-icon green">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"
                                />
                                <circle
                                    cx="12"
                                    cy="10"
                                    r="2.5"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2>Endereço</h2>

                            <p>
                                Informe o endereço residencial.
                            </p>
                        </div>

                    </div>

                    <div class="divider"></div>

                    <div class="grid">

                        <!-- CEP -->
                        <div
                            class="field"
                            :class="{
                                'has-error': erroCampo('cep'),
                            }"
                        >
                            <label for="cep">
                                CEP

                                <span class="required">
                                    *
                                </span>
                            </label>

                            <input
                                id="cep"
                                v-model="form.cep"
                                @input="
                                    form.cep =
                                        formatarCEP(form.cep)
                                "
                                type="text"
                                inputmode="numeric"
                                placeholder="00000-000"
                                autocomplete="postal-code"
                                maxlength="9"
                                :aria-invalid="!!erroCampo('cep')"
                            />

                            <span
                                v-if="erroCampo('cep')"
                                class="error"
                            >
                                {{ erroCampo('cep') }}
                            </span>
                        </div>

                        <!-- LOGRADOURO -->
                        <div
                            class="field field-large"
                            :class="{
                                'has-error':
                                    erroCampo('logradouro'),
                            }"
                        >
                            <label for="logradouro">
                                Logradouro

                                <span class="required">
                                    *
                                </span>
                            </label>

                            <input
                                id="logradouro"
                                v-model="form.logradouro"
                                type="text"
                                placeholder="Rua, Avenida, Travessa..."
                                autocomplete="street-address"
                                maxlength="255"
                                :aria-invalid="
                                    !!erroCampo('logradouro')
                                "
                            />

                            <span
                                v-if="erroCampo('logradouro')"
                                class="error"
                            >
                                {{ erroCampo('logradouro') }}
                            </span>
                        </div>

                        <!-- NÚMERO -->
                        <div
                            class="field"
                            :class="{
                                'has-error':
                                    erroCampo('numero'),
                            }"
                        >
                            <label for="numero">
                                Número

                                <span class="required">
                                    *
                                </span>
                            </label>

                            <input
                                id="numero"
                                v-model="form.numero"
                                type="text"
                                placeholder="Ex.: 123"
                                autocomplete="address-line2"
                                maxlength="10"
                                :aria-invalid="
                                    !!erroCampo('numero')
                                "
                            />

                            <span
                                v-if="erroCampo('numero')"
                                class="error"
                            >
                                {{ erroCampo('numero') }}
                            </span>
                        </div>

                        <!-- COMPLEMENTO -->
                        <div class="field">
                            <label for="complemento">
                                Complemento

                                <span class="optional">
                                    opcional
                                </span>
                            </label>

                            <input
                                id="complemento"
                                v-model="form.complemento"
                                type="text"
                                placeholder="Apartamento, casa..."
                                autocomplete="address-line2"
                                maxlength="255"
                            />
                        </div>

                        <!-- BAIRRO -->
                        <div
                            class="field"
                            :class="{
                                'has-error':
                                    erroCampo('bairro'),
                            }"
                        >
                            <label for="bairro">
                                Bairro

                                <span class="required">
                                    *
                                </span>
                            </label>

                            <input
                                id="bairro"
                                v-model="form.bairro"
                                type="text"
                                placeholder="Digite o bairro"
                                autocomplete="address-level3"
                                maxlength="255"
                                :aria-invalid="
                                    !!erroCampo('bairro')
                                "
                            />

                            <span
                                v-if="erroCampo('bairro')"
                                class="error"
                            >
                                {{ erroCampo('bairro') }}
                            </span>
                        </div>

                        <!-- CIDADE -->
                        <div
                            class="field"
                            :class="{
                                'has-error':
                                    erroCampo('cidade'),
                            }"
                        >
                            <label for="cidade">
                                Cidade

                                <span class="required">
                                    *
                                </span>
                            </label>

                            <input
                                id="cidade"
                                v-model="form.cidade"
                                type="text"
                                placeholder="Digite a cidade"
                                autocomplete="address-level2"
                                maxlength="255"
                                :aria-invalid="
                                    !!erroCampo('cidade')
                                "
                            />

                            <span
                                v-if="erroCampo('cidade')"
                                class="error"
                            >
                                {{ erroCampo('cidade') }}
                            </span>
                        </div>

                        <!-- ESTADO -->
                        <div
                            class="field"
                            :class="{
                                'has-error':
                                    erroCampo('estado'),
                            }"
                        >
                            <label for="estado">
                                Estado

                                <span class="required">
                                    *
                                </span>
                            </label>

                            <select
                                id="estado"
                                v-model="form.estado"
                                :aria-invalid="
                                    !!erroCampo('estado')
                                "
                            >
                                <option value="" disabled>
                                    Selecione o estado
                                </option>

                                <option
                                    v-for="estado in estados"
                                    :key="estado.sigla"
                                    :value="estado.sigla"
                                >
                                    {{ estado.sigla }} -
                                    {{ estado.nome }}
                                </option>
                            </select>

                            <span
                                v-if="erroCampo('estado')"
                                class="error"
                            >
                                {{ erroCampo('estado') }}
                            </span>
                        </div>

                    </div>

                </section>

                <!-- ======================================
                     AVISO
                ======================================= -->

                <div class="required-info">
                    <span class="required">*</span>

                    Campos obrigatórios
                </div>

                <!-- ======================================
                     AÇÕES
                ======================================= -->

                <div class="form-actions">

                    <Link
                        href="/pessoas"
                        class="btn-cancel"
                        :class="{
                            disabled: form.processing,
                        }"
                    >
                        Cancelar
                    </Link>

                    <button
                        type="submit"
                        class="btn-submit"
                        :disabled="
                            form.processing ||
                            !formularioValido
                        "
                    >

                        <span
                            v-if="form.processing"
                            class="spinner"
                        ></span>

                        <svg
                            v-else
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"
                            />
                            <path
                                d="M17 21v-8H7v8"
                            />
                            <path
                                d="M7 3v5h8"
                            />
                        </svg>

                        {{
                            form.processing
                                ? 'Cadastrando...'
                                : 'Cadastrar pessoa'
                        }}

                    </button>

                </div>

            </form>

        </div>

    </AppLayout>
</template>

<style scoped>
/* ========================================
   PÁGINA
======================================== */

.page {
    max-width: 1050px;
    margin: 0 auto;
    padding: 28px 24px 50px;
}

/* ========================================
   HEADER
======================================== */

.page-header {
    margin-bottom: 25px;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 12px;

    color: #94a3b8;

    font-size: 12px;
}

.breadcrumb a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 600;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.header-content h1 {
    margin: 0;

    color: #0f172a;

    font-size: 28px;
    font-weight: 700;

    letter-spacing: -0.5px;
}

.header-content p {
    margin: 7px 0 0;

    color: #64748b;

    font-size: 14px;
}

/* ========================================
   FORM
======================================== */

.form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* ========================================
   SEÇÕES
======================================== */

.section {
    background: white;

    border: 1px solid #e2e8f0;
    border-radius: 12px;

    padding: 24px;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 13px;
}

.section-header h2 {
    margin: 0;

    color: #1e293b;

    font-size: 17px;
    font-weight: 700;
}

.section-header p {
    margin: 4px 0 0;

    color: #94a3b8;

    font-size: 12px;
}

.section-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 40px;
    height: 40px;

    flex-shrink: 0;

    border-radius: 9px;
}

.section-icon svg {
    width: 20px;
    height: 20px;
}

.section-icon.blue {
    background: #eff6ff;
    color: #2563eb;
}

.section-icon.green {
    background: #ecfdf5;
    color: #059669;
}

.divider {
    height: 1px;

    margin: 20px 0;

    background: #f1f5f9;
}

/* ========================================
   GRID
======================================== */

.grid {
    display: grid;

    grid-template-columns: repeat(2, minmax(0, 1fr));

    gap: 18px;
}

.field-full {
    grid-column: 1 / -1;
}

.field-large {
    grid-column: span 1;
}

/* ========================================
   CAMPOS
======================================== */

.field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.field label {
    display: flex;
    align-items: center;
    gap: 4px;

    color: #334155;

    font-size: 13px;
    font-weight: 600;
}

.required {
    color: #dc2626;
}

.optional {
    margin-left: 3px;

    color: #94a3b8;

    font-size: 11px;
    font-weight: 400;
}

.field input,
.field select {
    width: 100%;
    box-sizing: border-box;

    height: 42px;

    padding: 0 12px;

    border: 1px solid #cbd5e1;
    border-radius: 8px;

    outline: none;

    background: white;

    color: #334155;

    font-family: inherit;
    font-size: 14px;

    transition:
        border-color 0.15s,
        box-shadow 0.15s,
        background 0.15s;
}

.field input::placeholder {
    color: #94a3b8;
}

.field input:focus,
.field select:focus {
    border-color: #2563eb;

    box-shadow:
        0 0 0 3px rgba(37, 99, 235, 0.1);
}

.field.has-error input,
.field.has-error select {
    border-color: #ef4444;

    background: #fffafa;
}

.field.has-error input:focus,
.field.has-error select:focus {
    border-color: #ef4444;

    box-shadow:
        0 0 0 3px rgba(239, 68, 68, 0.1);
}

/* ========================================
   ERROS
======================================== */

.error {
    display: flex;
    align-items: center;
    gap: 4px;

    color: #dc2626;

    font-size: 12px;
    line-height: 1.3;
}

.error::before {
    content: '!';
    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: 14px;
    height: 14px;

    border-radius: 50%;

    background: #fee2e2;

    font-size: 9px;
    font-weight: 700;
}

/* ========================================
   AVISO
======================================== */

.required-info {
    color: #64748b;

    font-size: 12px;
}

/* ========================================
   AÇÕES
======================================== */

.form-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;

    gap: 10px;

    padding-top: 5px;
}

.btn-cancel,
.btn-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    height: 42px;

    padding: 0 17px;

    border-radius: 8px;

    font-family: inherit;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    transition:
        background 0.15s,
        border-color 0.15s,
        color 0.15s,
        opacity 0.15s;
}

.btn-cancel {
    border: 1px solid #cbd5e1;

    background: white;

    color: #475569;

    cursor: pointer;
}

.btn-cancel:hover:not(.disabled) {
    background: #f8fafc;
    border-color: #94a3b8;
}

.btn-cancel.disabled {
    pointer-events: none;
    opacity: 0.5;
}

.btn-submit {
    min-width: 175px;

    border: none;

    background: #2563eb;

    color: white;

    cursor: pointer;

    box-shadow:
        0 2px 5px rgba(37, 99, 235, 0.2);
}

.btn-submit svg {
    width: 17px;
    height: 17px;
}

.btn-submit:hover:not(:disabled) {
    background: #1d4ed8;

    box-shadow:
        0 4px 10px rgba(37, 99, 235, 0.25);
}

.btn-submit:disabled {
    opacity: 0.55;
    cursor: not-allowed;
    box-shadow: none;
}

/* ========================================
   SPINNER
======================================== */

.spinner {
    width: 16px;
    height: 16px;

    border: 2px solid rgba(255, 255, 255, 0.35);
    border-top-color: white;

    border-radius: 50%;

    animation: spin 0.7s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* ========================================
   RESPONSIVO
======================================== */

@media (max-width: 700px) {

    .page {
        padding: 20px 12px 40px;
    }

    .header-content h1 {
        font-size: 24px;
    }

    .section {
        padding: 18px;
    }

    .grid {
        grid-template-columns: 1fr;
    }

    .field-full {
        grid-column: auto;
    }

    .form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .btn-cancel,
    .btn-submit {
        width: 100%;
    }
}
</style>
