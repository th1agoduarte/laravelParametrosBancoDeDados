<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import CarrocelPrincipal from "@/Pages/Principal/Partials/CarrocelPrincipal.vue";
import CarrocelVagas from "@/Pages/Principal/Partials/CarrocelVagas.vue";
import CarrocelParaceiros from "@/Pages/Principal/Partials/CarrocelParaceiros.vue";
import SessaoDoisConteudo from "@/Pages/Principal/Partials/SessaoDoisConteudo.vue";
import LinksSessaoDois from "@/Pages/Principal/Partials/LinksSessaoDois.vue";

import BotaoPadrao from "@/Layouts/_partials/BotaoPadrao";
import LinkBotaoPadrao from "@/Layouts/_partials/LinkBotaoPadrao";
const name = "Home";
const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
  title: String,
});
</script>
<style lang="scss" src="@/Assets/Styles/App.scss"></style>
<style lang="scss" src="@/Assets/Styles/PrincipalLayout.scss"></style>
<template>
  <AppLayout :title="title">
    <div class="carrocel-principal centraliza-conteudo">
      <CarrocelPrincipal class="conteiner" />
    </div>
    <div class="sessao-um centraliza-conteudo">
      <SessaoDoisConteudo />
    </div>
    <div class="sessao-vagas centraliza-conteudo">
      <CarrocelVagas />
    </div>
    <div class="sessao-banner centraliza-conteudo">
      <img src="/storage/img/profissoes.png" class="block w-full fundo" alt="..." />
      <p class="texto">Orgulho em fazer parte da construção do seu futuro!</p>
    </div>
    <div class="sessao-parceiros centraliza-conteudo">
      <CarrocelParaceiros />
    </div>
  </AppLayout>
</template>
