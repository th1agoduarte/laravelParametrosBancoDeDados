<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import "tw-elements";
const name = "CarrocelParceiros";
const props = defineProps({});
</script>
<template>
  <div class="conteiner centraliza-conteudo">
    <div class="sessao-parceiros-conteudo centraliza-all">
      <h3 class="titulo-parceiros">Quem está com a gente</h3>
      <div class="carrocel-parceiros">
        <img src="/storage/img/sebraeLogo1.png" class="block w-full fundo" alt="..." />
        <img src="/storage/img/fiocruz.png" class="block w-full fundo" alt="..." />
        <img src="/storage/img/tre.png" class="block w-full fundo" alt="..." />
        <img src="/storage/img/x5beb008c68331.png" class="block w-full fundo" alt="..." />
        <img src="/storage/img/ministerioDaInfraestrutura300x184250.png" class="block w-full fundo" alt="..." />
        <img src="/storage/img/itaipuLogo.png" class="block w-full fundo" alt="..." />
        <img src="/storage/img/maxresdefault.png" class="block w-full fundo" alt="..." />
      </div>
    </div>
  </div>
</template>
