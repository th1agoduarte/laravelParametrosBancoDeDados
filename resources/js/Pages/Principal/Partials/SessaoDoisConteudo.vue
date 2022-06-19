<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import LinksSessaoDois from "@/Pages/Principal/Partials/LinksSessaoDois.vue";

import BotaoPadrao from "@/Layouts/_partials/BotaoPadrao";

const name = "LinksSessaoDois";
const props = defineProps({});
</script>
<template>
  <div class="conteiner">
    <div class="card-estudante">
      <div class="dividir centraliza-all mw350 mh260">
        <div class="painelVerde"></div>
        <div class="painelSobreposto">
          <img src="/storage/img/mochila.png" id="mochila" alt="Mochila" />
          <div>
            <div class="texto-estudante">
              <p>Você é<br />Estudante?</p>
            </div>
            <div>
              <BotaoPadrao
                :descricao="'Cadastre-se'"
                :classes="['verde', 'padraoBotoCadastrarse']"
                :icone="''"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="dividir mw350 mh260 centraliza-all">
        <LinksSessaoDois />
      </div>
    </div>
  </div>
</template>
