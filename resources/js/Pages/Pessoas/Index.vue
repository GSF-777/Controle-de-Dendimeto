<script setup>
import { computed, ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '../layouts/layouts.vue';

const props = defineProps({
    pessoas: {
        type: Array,
        default: () => [],
    },
});

const busca = ref('');
const excluindo = ref(null);

const pessoasFiltradas = computed(() => {
    const termo = busca.value.trim().toLowerCase();

    if (!termo) {
        return props.pessoas;
    }

    return props.pessoas.filter((pessoa) => {
        const nome = pessoa.nome?.toLowerCase() ?? '';
        const cpf = pessoa.cpf?.toLowerCase() ?? '';
        const telefone = pessoa.telefone?.toLowerCase() ?? '';

        return (
            nome.includes(termo) ||
            cpf.includes(termo) ||
            telefone.includes(termo)
        );
    });
});

const limparBusca = () => {
    busca.value = '';
};

const confirmarExclusao = (pessoa) => {
    const confirmado = window.confirm(
        `Tem certeza que deseja excluir "${pessoa.nome}"?\n\n` +
        'Essa ação não poderá ser desfeita.'
    );

    if (!confirmado) {
        return;
    }

    excluindo.value = pessoa.id;

    router.delete(`/pessoas/${pessoa.id}`, {
        preserveScroll: true,

        onFinish: () => {
            excluindo.value = null;
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="page">

            <!-- CABEÇALHO -->
            <header class="page-header">

                <div>
                    <div class="title-row">
                        <h1>Pessoas</h1>

                        <span class="total-badge">
                            {{ props.pessoas.length }}
                        </span>
                    </div>

                    <p>
                        Gerencie as pessoas cadastradas no sistema.
                    </p>
                </div>

                <Link
                    href="/pessoas/create"
                    class="btn-primary"
                >
                    <span class="btn-icon">+</span>
                    Nova pessoa
                </Link>

            </header>

            <!-- FILTROS / BUSCA -->
            <section class="filter-card">

                <div class="filter-header">
                    <div>
                        <h2>Lista de pessoas</h2>

                        <p>
                            {{ pessoasFiltradas.length }}
                            {{
                                pessoasFiltradas.length === 1
                                    ? 'registro encontrado'
                                    : 'registros encontrados'
                            }}
                        </p>
                    </div>
                </div>

                <div class="search-box">

                    <svg
                        class="search-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-4-4"></path>
                    </svg>

                    <input
                        v-model="busca"
                        type="search"
                        placeholder="Buscar por nome, CPF ou telefone..."
                        autocomplete="off"
                    />

                    <button
                        v-if="busca"
                        type="button"
                        class="clear-search"
                        @click="limparBusca"
                        aria-label="Limpar busca"
                    >
                        ×
                    </button>

                </div>

            </section>

            <!-- TABELA -->
            <section class="table-card">

                <div class="table-wrapper">

                    <table>

                        <thead>
                            <tr>
                                <th>Pessoa</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Atendimento</th>
                                <th class="actions-header">
                                    Ações
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr
                                v-for="pessoa in pessoasFiltradas"
                                :key="pessoa.id"
                            >

                                <!-- PESSOA -->
                                <td>
                                    <div class="person">

                                        <div class="avatar">
                                            {{
                                                pessoa.nome
                                                    ?.charAt(0)
                                                    ?.toUpperCase()
                                            }}
                                        </div>

                                        <div class="person-info">

                                            <strong>
                                                {{ pessoa.nome }}
                                            </strong>

                                            <small>
                                                Cadastro #{{ pessoa.id }}
                                            </small>

                                        </div>

                                    </div>
                                </td>

                                <!-- CPF -->
                                <td>
                                    <span class="cpf">
                                        {{ pessoa.cpf }}
                                    </span>
                                </td>

                                <!-- TELEFONE -->
                                <td>
                                    {{ pessoa.telefone }}
                                </td>

                                <!-- ATENDIMENTO -->
                                <td>

                                    <span
                                        class="status"
                                        :class="{
                                            presencial:
                                                pessoa.tipo_atendimento === 'Presencial',

                                            telefone:
                                                pessoa.tipo_atendimento === 'Telefone',

                                            online:
                                                pessoa.tipo_atendimento === 'Online',
                                        }"
                                    >
                                        <span class="status-dot"></span>

                                        {{ pessoa.tipo_atendimento }}

                                    </span>

                                </td>

                                <!-- AÇÕES -->
                                <td>

                                    <div class="actions">

                                        <Link
                                            :href="`/pessoas/${pessoa.id}`"
                                            class="action action-view"
                                            title="Visualizar pessoa"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"
                                                />
                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="2.5"
                                                />
                                            </svg>

                                            Ver
                                        </Link>

                                        <Link
                                            :href="`/pessoas/${pessoa.id}/edit`"
                                            class="action action-edit"
                                            title="Editar pessoa"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M12 20h9"
                                                />
                                                <path
                                                    d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"
                                                />
                                            </svg>

                                            Editar
                                        </Link>

                                        <button
                                            type="button"
                                            class="action action-delete"
                                            :disabled="excluindo === pessoa.id"
                                            :title="
                                                excluindo === pessoa.id
                                                    ? 'Excluindo...'
                                                    : 'Excluir pessoa'
                                            "
                                            @click="confirmarExclusao(pessoa)"
                                        >
                                            <svg
                                                v-if="excluindo !== pessoa.id"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M3 6h18"
                                                />
                                                <path
                                                    d="M8 6V4h8v2"
                                                />
                                                <path
                                                    d="M19 6l-1 14H6L5 6"
                                                />
                                                <path
                                                    d="M10 11v5"
                                                />
                                                <path
                                                    d="M14 11v5"
                                                />
                                            </svg>

                                            <span
                                                v-else
                                                class="spinner"
                                            ></span>

                                            {{
                                                excluindo === pessoa.id
                                                    ? 'Excluindo...'
                                                    : 'Excluir'
                                            }}
                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <!-- SEM RESULTADOS -->
                            <tr
                                v-if="pessoasFiltradas.length === 0"
                            >
                                <td
                                    colspan="5"
                                    class="empty"
                                >

                                    <div class="empty-content">

                                        <div class="empty-icon">
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.7"
                                            >
                                                <circle
                                                    cx="11"
                                                    cy="11"
                                                    r="7"
                                                />
                                                <path
                                                    d="m20 20-4-4"
                                                />
                                            </svg>
                                        </div>

                                        <h3>
                                            Nenhuma pessoa encontrada
                                        </h3>

                                        <p v-if="busca">
                                            Não encontramos resultados
                                            para
                                            <strong>
                                                "{{ busca }}"
                                            </strong>.
                                        </p>

                                        <p v-else>
                                            Ainda não existem pessoas
                                            cadastradas.
                                        </p>

                                        <button
                                            v-if="busca"
                                            type="button"
                                            class="btn-secondary"
                                            @click="limparBusca"
                                        >
                                            Limpar busca
                                        </button>

                                        <Link
                                            v-else
                                            href="/pessoas/create"
                                            class="btn-secondary"
                                        >
                                            Cadastrar primeira pessoa
                                        </Link>

                                    </div>

                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </section>

        </div>
    </AppLayout>
</template>

<style scoped>
/* ========================================
   PÁGINA
======================================== */

.page {
    max-width: 1250px;
    margin: 0 auto;
    padding: 28px 24px 50px;
}

/* ========================================
   HEADER
======================================== */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 24px;
}

.title-row {
    display: flex;
    align-items: center;
    gap: 10px;
}

.title-row h1 {
    margin: 0;
    color: #0f172a;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: -0.5px;
}

.page-header p {
    margin: 7px 0 0;
    color: #64748b;
    font-size: 14px;
}

.total-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-width: 28px;
    height: 24px;

    padding: 0 8px;

    border-radius: 20px;

    background: #eff6ff;
    color: #2563eb;

    font-size: 12px;
    font-weight: 700;
}

/* ========================================
   BOTÃO PRINCIPAL
======================================== */

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 11px 17px;

    border-radius: 8px;

    background: #2563eb;
    color: white;

    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    box-shadow: 0 2px 5px rgba(37, 99, 235, 0.2);

    transition:
        background 0.2s,
        transform 0.2s,
        box-shadow 0.2s;
}

.btn-primary:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
}

.btn-icon {
    font-size: 18px;
    line-height: 1;
}

/* ========================================
   FILTROS
======================================== */

.filter-card {
    background: white;

    border: 1px solid #e2e8f0;
    border-radius: 12px;

    padding: 18px 20px;

    margin-bottom: 18px;
}

.filter-header {
    margin-bottom: 15px;
}

.filter-header h2 {
    margin: 0;

    color: #1e293b;

    font-size: 15px;
    font-weight: 700;
}

.filter-header p {
    margin: 4px 0 0;

    color: #94a3b8;

    font-size: 12px;
}

/* ========================================
   BUSCA
======================================== */

.search-box {
    position: relative;

    max-width: 500px;
}

.search-box input {
    width: 100%;
    box-sizing: border-box;

    height: 43px;

    padding: 0 42px;

    border: 1px solid #cbd5e1;
    border-radius: 8px;

    outline: none;

    color: #334155;

    font-size: 14px;

    background: #fff;

    transition:
        border-color 0.2s,
        box-shadow 0.2s;
}

.search-box input::placeholder {
    color: #94a3b8;
}

.search-box input:focus {
    border-color: #2563eb;

    box-shadow:
        0 0 0 3px rgba(37, 99, 235, 0.1);
}

.search-icon {
    position: absolute;

    left: 14px;
    top: 50%;

    width: 18px;
    height: 18px;

    transform: translateY(-50%);

    color: #94a3b8;

    pointer-events: none;
}

.clear-search {
    position: absolute;

    right: 10px;
    top: 50%;

    width: 25px;
    height: 25px;

    transform: translateY(-50%);

    border: none;
    border-radius: 50%;

    background: #f1f5f9;

    color: #64748b;

    font-size: 18px;
    line-height: 1;

    cursor: pointer;
}

.clear-search:hover {
    background: #e2e8f0;
    color: #334155;
}

/* ========================================
   TABELA
======================================== */

.table-card {
    overflow: hidden;

    background: white;

    border: 1px solid #e2e8f0;
    border-radius: 12px;

    box-shadow:
        0 1px 3px rgba(15, 23, 42, 0.04);
}

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;

    border-collapse: collapse;

    min-width: 900px;
}

thead {
    background: #f8fafc;
}

th {
    padding: 13px 18px;

    color: #64748b;

    font-size: 11px;
    font-weight: 700;

    text-align: left;
    text-transform: uppercase;

    letter-spacing: 0.04em;

    white-space: nowrap;
}

td {
    padding: 15px 18px;

    border-top: 1px solid #f1f5f9;

    color: #475569;

    font-size: 14px;
}

tbody tr {
    transition: background 0.15s;
}

tbody tr:hover {
    background: #f8fafc;
}

.actions-header {
    text-align: right;
}

/* ========================================
   PESSOA
======================================== */

.person {
    display: flex;
    align-items: center;
    gap: 11px;
}

.avatar {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 38px;
    height: 38px;

    flex-shrink: 0;

    border-radius: 50%;

    background: #dbeafe;
    color: #2563eb;

    font-size: 14px;
    font-weight: 700;
}

.person-info strong {
    display: block;

    color: #1e293b;

    font-size: 14px;
    font-weight: 600;
}

.person-info small {
    display: block;

    margin-top: 3px;

    color: #94a3b8;

    font-size: 11px;
}

.cpf {
    font-family: monospace;
    color: #475569;
}

/* ========================================
   STATUS
======================================== */

.status {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 5px 9px;

    border-radius: 20px;

    font-size: 12px;
    font-weight: 600;
}

.status-dot {
    width: 6px;
    height: 6px;

    border-radius: 50%;

    background: currentColor;
}

.status.presencial {
    background: #dcfce7;
    color: #15803d;
}

.status.telefone {
    background: #fef3c7;
    color: #b45309;
}

.status.online {
    background: #ede9fe;
    color: #7c3aed;
}

/* ========================================
   AÇÕES
======================================== */

.actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 4px;
}

.action {
    display: inline-flex;
    align-items: center;
    gap: 5px;

    padding: 7px 8px;

    border: none;
    border-radius: 6px;

    background: transparent;

    font-family: inherit;

    font-size: 12px;
    font-weight: 600;

    text-decoration: none;

    cursor: pointer;

    transition:
        background 0.15s,
        color 0.15s;
}

.action svg {
    width: 15px;
    height: 15px;
}

.action-view {
    color: #2563eb;
}

.action-view:hover {
    background: #eff6ff;
}

.action-edit {
    color: #475569;
}

.action-edit:hover {
    background: #f1f5f9;
}

.action-delete {
    color: #dc2626;
}

.action-delete:hover:not(:disabled) {
    background: #fef2f2;
}

.action:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* ========================================
   LOADING
======================================== */

.spinner {
    width: 14px;
    height: 14px;

    border: 2px solid #fecaca;
    border-top-color: #dc2626;

    border-radius: 50%;

    animation: spin 0.7s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* ========================================
   VAZIO
======================================== */

.empty {
    padding: 60px 20px;
}

.empty-content {
    display: flex;
    flex-direction: column;
    align-items: center;

    text-align: center;
}

.empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 55px;
    height: 55px;

    margin-bottom: 14px;

    border-radius: 50%;

    background: #f1f5f9;
    color: #94a3b8;
}

.empty-icon svg {
    width: 25px;
    height: 25px;
}

.empty h3 {
    margin: 0;

    color: #334155;

    font-size: 16px;
}

.empty p {
    max-width: 400px;

    margin: 7px 0 17px;

    color: #94a3b8;

    font-size: 13px;
}

.empty p strong {
    color: #64748b;
}

.btn-secondary {
    display: inline-flex;
    align-items: center;

    padding: 8px 13px;

    border: 1px solid #cbd5e1;
    border-radius: 7px;

    background: white;
    color: #475569;

    font-family: inherit;
    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    cursor: pointer;
}

.btn-secondary:hover {
    background: #f8fafc;
}

/* ========================================
   RESPONSIVO
======================================== */

@media (max-width: 700px) {

    .page {
        padding: 20px 12px 40px;
    }

    .page-header {
        align-items: stretch;
        flex-direction: column;
    }

    .title-row h1 {
        font-size: 24px;
    }

    .btn-primary {
        justify-content: center;
    }

    .filter-card {
        padding: 16px;
    }

    .search-box {
        max-width: none;
    }

    .table-card {
        border-radius: 10px;
    }
}
</style>
