<script setup>
import Sidebar from './navbar.vue';
</script>

<template>
    <div class="app-layout">

    <Sidebar />

    <main class="main-content">
        <header class="header">
            <div>
                <h1>Controle de Atendimento</h1>
            </div>

            <div class="user">
                <div class="user-avatar">
                    U
                </div>

                <div class="user-info">
                    <strong>Usuário</strong>
                    <span>Administrador</span>
                </div>
            </div>
        </header>

        <section class="page-content">
            <slot />
        </section>
    </main>

</div>

</template>

<style scoped>
.app-layout {
    display: flex;
    min-height: 100vh;
    background: #f8fafc;
}

.main-content {
    flex: 1;
    min-width: 0;
}

/* HEADER */
.header {
    height: 72px;
    background: white;
    border-bottom: 1px solid #e5e7eb;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 32px;
}

.header h1 {
    margin: 0;
    font-size: 20px;
    color: #111827;
}

/* USUÁRIO */
.user {
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;

    background: #2563eb;
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    font-weight: bold;
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-info strong {
    font-size: 14px;
    color: #1f2937;
}

.user-info span {
    font-size: 12px;
    color: #64748b;
}

/* CONTEÚDO */
.page-content {
    padding: 32px;
}

@media (max-width: 768px) {
    .header {
        padding: 0 20px;
    }

    .user-info {
        display: none;
    }

    .page-content {
        padding: 20px;
    }
}
</style>
