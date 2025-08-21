<template>
    <!-- BEGIN FOOTER -->
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">{{app_name}} © {{year}} <a target="_blank" href="/">CIATécnica</a>, All rights reserved.</p>
        </div>
        <div class="footer-section f-section-2">
            <p class="">
                System Version: {{version}}
            </p>
        </div>
    </div>
    <!-- END FOOTER -->
</template>
<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/inertia-vue3";
const year = computed(() => usePage().props.value.year);
const version = computed(() => usePage().props.value.version);
const app_name = computed(() => usePage().props.value.app_name);
</script>
