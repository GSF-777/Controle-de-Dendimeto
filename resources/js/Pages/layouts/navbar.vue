<template>
    <aside class="sidebar">
        <!-- Logo -->
        <div class="sidebar-logo">
            <div class="logo-icon">
                +
            </div>

        <div class="logo-text">
            <h2>Controle</h2>
            <span>Atendimento</span>
        </div>
    </div>

    <!-- Navegação -->
    <nav class="sidebar-menu">
        <Link
            href="/"
            class="menu-item"
            :class="{ active: $page.url === '/' }"
        >
            <span class="menu-icon">⌂</span>
            <span>Dashboard</span>
        </Link>

        <Link
            href="pessoas/create"
            class="menu-item"
            :class="{ active: $page.url.startsWith('pessoas/create') }"
        >
            <span class="menu-icon">♙</span>
            <span>Pacientes</span>
        </Link>

        <Link
            href="/pessoas"
            class="menu-item"
            :class="{ active: $page.url.startsWith('/pessoas') }"
        >
            <span class="menu-icon">▣</span>
            <span>Atendimentos</span>
        </Link>

        <Link
            href="/consultas"
            class="menu-item"
            :class="{ active: $page.url.startsWith('/consultas') }"
        >
            <span class="menu-icon">◷</span>
            <span>Consultas</span>
        </Link>

        <Link
            href="/vacinas"
            class="menu-item"
            :class="{ active: $page.url.startsWith('/vacinas') }"
        >
            <span class="menu-icon">✚</span>
            <span>Vacinas</span>
        </Link>
    </nav>

    <!-- Parte inferior -->
    <div class="sidebar-bottom">
        <Link
            href="/configuracoes"
            class="menu-item"
        >
            <span class="menu-icon">⚙</span>
            <span>Configurações</span>
        </Link>

        <button class="logout-button">
            <span class="menu-icon">↪</span>
            <span>Sair</span>
        </button>
    </div>
</aside>

</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<style scoped>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;

    width: 260px;
    height: 100vh;

    background: #ffffff;

    border-right: 1px solid #e5e7eb;

    display: flex;
    flex-direction: column;

    padding: 20px 14px;

    box-sizing: border-box;
}

/* LOGO */

.sidebar-logo {
    display: flex;

    align-items: center;

    gap: 12px;

    padding: 10px 12px 30px;

    border-bottom: 1px solid #e5e7eb;
}

.logo-icon {
    width: 42px;

    height: 42px;

    border-radius: 10px;

    background: #2563eb;

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 28px;

    font-weight: bold;
}

.logo-text {
    display: flex;

    flex-direction: column;
}

.logo-text h2 {
    margin: 0;

    font-size: 17px;

    color: #111827;
}

.logo-text span {
    font-size: 12px;

    color: #6b7280;
}

/* MENU */

.sidebar-menu {
    display: flex;

    flex-direction: column;

    gap: 5px;

    margin-top: 25px;
}

.menu-item,
.logout-button {
    width: 100%;

    padding: 12px 14px;

    border-radius: 8px;

    border: none;

    background: transparent;

    color: #64748b;

    text-decoration: none;

    font-size: 14px;

    cursor: pointer;

    display: flex;

    align-items: center;

    gap: 12px;

    transition: 0.2s;
}

.menu-item:hover,
.logout-button:hover {
    background: #f1f5f9;

    color: #2563eb;
}

.menu-item.active {
    background: #eff6ff;

    color: #2563eb;

    font-weight: 600;
}

.menu-icon {
    width: 20px;

    text-align: center;

    font-size: 18px;
}

/* PARTE INFERIOR */

.sidebar-bottom {
    margin-top: auto;

    padding-top: 20px;

    border-top: 1px solid #e5e7eb;
}

/* RESPONSIVO */

@media (max-width: 768px) {

    .sidebar {
        width: 76px;

        padding: 20px 10px;
    }

    .logo-text,
    .menu-item span:last-child,
    .logout-button span:last-child {
        display: none;
    }

    .sidebar-logo {
        justify-content: center;

        padding: 10px 0 30px;
    }

    .menu-item,
    .logout-button {
        justify-content: center;

        padding: 14px;
    }
}
</style>
