<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import RodapeLayout from '@/Layouts/RodapeLayout.vue';
import NavPrincipalLayout from '@/Layouts/NavPrincipalLayout.vue';
import NavTopoLayout from '@/Layouts/NavTopoLayout.vue';

defineProps({
    title: String,
});

const logout = () => {
    Inertia.post(route('logout'));
};
</script>
<style lang="scss" src="@/Assets/Styles/App.scss" ></style>
<template>
    <Head :title="title" />
    <NavTopoLayout></NavTopoLayout>
    <NavPrincipalLayout></NavPrincipalLayout>
    <div class="conteudo-principal">
        <slot></slot>
    </div>
    <RodapeLayout></RodapeLayout>
</template>
