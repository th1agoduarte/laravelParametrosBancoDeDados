<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
const name = "Home"
const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    title: String,
});
</script>
<style lang="scss" src="@/Assets/Styles/App.scss" ></style>
<template>
    <AppLayout :title="title">
        #prinpcipal<br>
        {{laravelVersion}}
    </AppLayout>
</template>

