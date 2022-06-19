<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import "tw-elements";
const name = "CarrocelVagas";
const props = defineProps({});
</script>
<template>
  <div class="conteiner centraliza-conteudo">
    <div class="sessao-vagas-conteudo centraliza-all">
      <h3 class="titulo-vagas">VAGAS DE ESTÁGIO DISPONÍVEIS</h3>
      <div class="slides-vagas">
        <div class="slides-vagas-seta">
          <img
            src="/storage/img/setaEsquerdaCarrossel.png"
            class="block w-full"
            alt="..."
          />
        </div>
        <div class="slides-vagas-conteudo">
          <div class="card-vagas">
            <div class="cabecalho">
              <img
                src="/storage/img/grupoDeMascara49.png"
                class="block w-full"
                alt="..."
              />
              <h6>ESTÁGIO NÃO OBRIGATÓRIO</h6>
            </div>
            <div class="corpo">
              <h5 class="titulo">Arquitetura e Urbanismo</h5>
              <h6 class="localidade">Foz do Iguaçu - PR</h6>
            </div>
            <div class="rodape">
              <a id="vejamais" href="#" target="_self">Veja Mais</a>
              <a id="cadastrese" href="#" target="_self">Cadastra-se</a>
            </div>
          </div>
        </div>
        <div class="slides-vagas-seta">
          <img
            src="/storage/img/setaDiretaCarrossel.png"
            class="block w-full"
            alt="..."
          />
        </div>
      </div>
    </div>
  </div>
</template>
