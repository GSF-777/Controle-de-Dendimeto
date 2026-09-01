<script setup>
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '../layouts/layouts.vue';

const props = defineProps({
    pessoas: {
        type: Array,
        default: () => [],
    },
});

const busca = ref('');

const pessoasFiltradas = computed(() => {
    if (!busca.value) {
        return props.pessoas;
    }

    const termo = busca.value.toLowerCase();

    return props.pessoas.filter((pessoa) => {
        return (
            pessoa.nome.toLowerCase().includes(termo) ||
            pessoa.cpf.toLowerCase().includes(termo)
        );
    });
});
</script>

<template>
    <AppLayout>
        <div class="container">

```
        <div class="header">
            <div>
                <h1>Pessoas</h1>
                <p>Gerencie as pessoas cadastradas no sistema.</p>
            </div>

            <Link
                href="/pessoas/create"
                class="btn-create"
            >
                + Nova pessoa
            </Link>
        </div>

        <!-- Busca -->
        <div class="search-container">
            <input
                v-model="busca"
                type="text"
                placeholder="Buscar por nome ou CPF..."
            />
        </div>

        <!-- Tabela -->
        <div class="table-container">

            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Tipo de atendimento</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="pessoa in pessoasFiltradas"
                        :key="pessoa.id"
                    >
                        <td>
                            {{ pessoa.nome }}
                        </td>

                        <td>
                            {{ pessoa.cpf }}
                        </td>

                        <td>
                            {{ pessoa.telefone }}
                        </td>

                        <td>
                            <span class="badge">
                                {{ pessoa.tipo_atendimento }}
                            </span>
                        </td>

                        <td>
                            <Link
                                :href="`/pessoas/${pessoa.id}`"
                                class="btn-view"
                            >
                                Ver
                            </Link>
                        </td>
                    </tr>

                    <tr v-if="pessoasFiltradas.length === 0">
                        <td
                            colspan="5"
                            class="empty"
                        >
                            Nenhuma pessoa encontrada.
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>

    </div>
</AppLayout>
```

</template>

<style scoped>
.container {
    max-width: 1200px;
    margin: 0 auto;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.header h1 {
    margin: 0;
    color: #1e293b;
}

.header p {
    color: #64748b;
    margin-top: 6px;
}

/* BOTÃO */
.btn-create {
    background: #2563eb;
    color: white;
    text-decoration: none;
    padding: 11px 18px;
    border-radius: 8px;
    font-size: 14px;
}

/* BUSCA */
.search-container {
    margin-bottom: 20px;
}

.search-container input {
    width: 100%;
    max-width: 400px;
    padding: 12px 15px;

    border: 1px solid #cbd5e1;
    border-radius: 8px;

    outline: none;
}

.search-container input:focus {
    border-color: #2563eb;
}

/* TABELA */
.table-container {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    text-align: left;
    padding: 15px;
    background: #f8fafc;
    color: #64748b;
    font-size: 13px;
}

td {
    padding: 15px;
    border-top: 1px solid #e2e8f0;
    color: #334155;
}

.badge {
    padding: 5px 10px;
    background: #eff6ff;
    color: #2563eb;
    border-radius: 20px;
    font-size: 12px;
}

.btn-view {
    text-decoration: none;
    color: #2563eb;
    font-weight: 500;
}

.empty {
    text-align: center;
    padding: 30px;
    color: #64748b;
}

/* RESPONSIVO */
@media (max-width: 700px) {
    .header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .table-container {
        overflow-x: auto;
    }

    table {
        min-width: 700px;
    }
}
</style>
