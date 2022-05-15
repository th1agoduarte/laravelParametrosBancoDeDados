<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    title: String,
});
</script>
<style lang="scss" src="@/Assets/Styles/App.scss" ></style>
<template>
    <div>
        {{props.title}}
    </div>
</template>
