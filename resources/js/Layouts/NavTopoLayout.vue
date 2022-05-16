<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineComponent } from '@vue/runtime-core';
import LinkBotaoPadrao from '@/Layouts/_partials/LinkBotaoPadrao'
import BotaoPadrao from "@/Layouts/_partials/BotaoPadrao";

const props = defineProps({
    title: String,
});
const definicoes = defineComponent({
  name:'NavTopoPrincipal'
});
</script>
<style lang="scss" src="@/Assets/Styles/NavTopoHome.scss" scoped ></style>
<template>
    <div class="nav-topo-principal">
        <div class="conteiner nav-topo">
            <LinkBotaoPadrao id="doacoes" :link="'#'" :target="'_self'" :descricao="'Doações'" :icone="'favorite'" :classes="['verde']" />
            <LinkBotaoPadrao id="login-sysestagio" :link="'#'" :target="'_self'" :descricao="'Faça seu Login'" :icone="'account_circle_full'" :classes="['azul']" />
            <BotaoPadrao style="font-size: 20px; margin-inline-end: 10px;" :descricao="''" :classes="'preto'" :icone="'search'" />
        </div>
    </div>
</template>
