<template>
    <!-- BEGIN FOOTER -->
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">© {{year}} <a target="_blank" href="/">{{app_name}}</a>. All Rights Reserved™.</p>
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
import { Link, usePage } from "@inertiajs/vue3";
const year = computed(() => usePage().props?.year);
const version = computed(() => usePage().props?.version);
const page = usePage()
const app_name = computed(() => (page.props?.value?.app_name ?? page.props?.app_name ?? 'Laravel'))
</script>
