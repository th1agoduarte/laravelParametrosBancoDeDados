<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import BotaoPadrao from "@/Layouts/_partials/BotaoPadrao";
import LinkBotaoPadrao from "@/Layouts/_partials/LinkBotaoPadrao";
const name = "LinksSessaoDois";
const props = defineProps({});
</script>
<template>
  <div class="centraliza-all links-central">
    <BotaoPadrao
      :descricao="'Vagas Estágio'"
      :classes="['verde','padraoBotoesSessaoDois']"
      :icone="''"
    />
    <BotaoPadrao
      :descricao="'Área de Concursos'"
      :classes="['verdeDois','padraoBotoesSessaoDois']"
      :icone="''"
    />
    <BotaoPadrao
      :descricao="'Editais'"
      :classes="['verdeTres','padraoBotoesSessaoDois']"
      :icone="''"
    />
  </div>
</template>
