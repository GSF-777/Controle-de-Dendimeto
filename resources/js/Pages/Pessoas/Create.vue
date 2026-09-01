<script setup>
import { useForm } from '@inertiajs/vue3';
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

const cadastrar = () => {
    form.post('/pessoas',{
        onSuccess: () => {
            form.reset();
        }
    });
};
</script>

<template>
    <AppLayout>
        <div class="container">
            <div class="header">
                <div>
                    <h1>Cadastrar Pessoa</h1>
                    <p>Preencha os dados abaixo para realizar o cadastro.</p>
                </div>
            </div>

```
        <form @submit.prevent="cadastrar" class="form">
            
            <div class="section">
                <h2>Dados pessoais</h2>

                <div class="grid">
                    <div class="field">
                        <label>Nome</label>

                        <input
                            v-model="form.nome"
                            type="text"
                            placeholder="Digite o nome"
                        />

                        <span v-if="form.errors.nome" class="error">
                            {{ form.errors.nome }}
                        </span>
                    </div>

                    <div class="field">
                        <label>CPF</label>

                        <input
                            v-model="form.cpf"
                            type="text"
                            placeholder="000.000.000-00"
                        />
                    </div>

                    <div class="field">
                        <label>Telefone</label>

                        <input
                            v-model="form.telefone"
                            type="text"
                            placeholder="(00) 00000-0000"
                        />
                    </div>

                    <div class="field">
                        <label>Tipo de atendimento</label>

                        <select v-model="form.tipo_atendimento">
                            <option value="">
                                Selecione
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
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Endereço</h2>

                <div class="grid">
                    <div class="field">
                        <label>CEP</label>

                        <input
                            v-model="form.cep"
                            type="text"
                            placeholder="00000-000"
                        />
                    </div>

                    <div class="field">
                        <label>Logradouro</label>

                        <input
                            v-model="form.logradouro"
                            type="text"
                            placeholder="Rua, Avenida..."
                        />
                    </div>

                    <div class="field">
                        <label>Número</label>

                        <input
                            v-model="form.numero"
                            type="text"
                            placeholder="Número"
                        />
                    </div>

                    <div class="field">
                        <label>Complemento</label>

                        <input
                            v-model="form.complemento"
                            type="text"
                            placeholder="Apartamento, casa..."
                        />
                    </div>

                    <div class="field">
                        <label>Bairro</label>

                        <input
                            v-model="form.bairro"
                            type="text"
                            placeholder="Digite o bairro"
                        />
                    </div>

                    <div class="field">
                        <label>Cidade</label>

                        <input
                            v-model="form.cidade"
                            type="text"
                            placeholder="Digite a cidade"
                        />
                    </div>

                    <div class="field">
                        <label>Estado</label>

                        <input
                            v-model="form.estado"
                            type="text"
                            maxlength="2"
                            placeholder="PI"
                        />
                    </div>
                </div>
            </div>

            <div class="actions">
                <button
                    type="submit"
                    :disabled="form.processing"
                >
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
```

</template>

<style scoped>
.container {
    max-width: 1000px;
    margin: 0 auto;
}

.header {
    margin-bottom: 30px;
}

.header h1 {
    margin: 0;
    font-size: 28px;
    color: #1e293b;
}

.header p {
    color: #64748b;
    margin-top: 8px;
}

.form {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.section {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 25px;
}

.section h2 {
    margin: 0 0 25px;
    font-size: 18px;
    color: #1e293b;
}

.grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.field {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.field label {
    font-size: 14px;
    font-weight: 500;
    color: #334155;
}

.field input,
.field select {
    width: 100%;
    box-sizing: border-box;
    padding: 11px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
}

.field input:focus,
.field select:focus {
    border-color: #2563eb;
}

.actions {
    display: flex;
    justify-content: flex-end;
}

.actions button {
    padding: 12px 22px;
    border: none;
    border-radius: 8px;
    background: #2563eb;
    color: white;
    font-size: 14px;
    cursor: pointer;
}

.actions button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.error {
    color: #dc2626;
    font-size: 12px;
}

@media (max-width: 700px) {
    .grid {
        grid-template-columns: 1fr;
    }
}
</style>
