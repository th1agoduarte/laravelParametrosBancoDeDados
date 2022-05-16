<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import LinkImgPadrao from '@/Layouts/_partials/LinkImgPadrao'
import Contato from '@/Layouts/_partials/Contato'
const props = defineProps({
  title: String,
});
</script>
<style lang="scss" src="@/Assets/Styles/RodapeHome.scss" scoped></style>
<template>
  <div class="rodape-principal">
    <div class="conteiner">
      <div class="direitos">
        <div>
          <img src="/storage/img/logoUpaP.png" alt="" sizes="" srcset="" />
        </div>
        <p>© Todos os direitos reservados 2021 | Universidade Patativa do Assaré</p>
        <p>
          Acesse nossas Redes Sociais:
          <LinkImgPadrao class="rede-social" :link="'#'" :classes="['rede-social']"  :icone="'grupoDeMascara1.png'" :target="'_self'" />
          <LinkImgPadrao class="rede-social" :link="'#'" :classes="['rede-social']"  :icone="'grupoDeMascara2.png'" :target="'_self'" />
          <LinkImgPadrao class="rede-social" :link="'#'" :classes="['rede-social']"  :icone="'grupoDeMascara3.png'" :target="'_self'" />
        </p>
      </div>
      <div class="divisoria"></div>
      <div class="atendimentos">
          <h3><strong>ATENDIMENTO UNIDADES</strong></h3>
          <div class="contatos">
              <Contato v-for="(contato,index ) in $page.props.contatos" :key="index" :contatos="contato" />
          </div>
      </div>
    </div>
  </div>
</template>
