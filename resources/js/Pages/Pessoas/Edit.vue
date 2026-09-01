<script setup>

import { Link } from '@inertiajs/vue3';
import { normalizeClass } from 'vue';

const props = defineProps({
    pessoa: {
        type: Array,
        default: () => [],
    },
});

</script>

<template>

<h1>oi estou em edit {{ pessoa}}</h1>

</template>