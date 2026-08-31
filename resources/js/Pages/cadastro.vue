```vue
<script setup>
import { Form } from "@inertiajs/vue3";
</script>

<template>
    <h1>Área de cadastro</h1>

    <br><br>

    <Form action="/cadastro_store" method="post">
        <label for="name">Nome:</label>
        <input
            id="name"
            type="text"
            name="name"
        />

        <br><br>

        <label for="cpf">CPF:</label>
        <input
            id="cpf"
            type="text"
            name="cpf"
        />

        <br><br>

        <label for="telefone">Telefone para contato:</label>
        <input
            id="telefone"
            type="text"
            name="telefone"
        />

        <br><br>

        <label for="tipo">Tipo de atendimento:</label>
        <input
            id="tipo"
            type="text"
            name="tipo"
        />

        <br><br>

        <button type="submit">
            Cadastrar
        </button>
    </Form>
</template>
```
