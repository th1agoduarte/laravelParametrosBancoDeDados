<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import BotaoPadrao from "@/Layouts/_partials/BotaoPadrao";
import LinkPadrao from "@/Layouts/_partials/LinkPadrao";
import { ref } from "@vue/reactivity";
import { onMounted, watchEffect } from "@vue/runtime-core";

const width = ref(2000);
const height = ref(2000);
const ocultaMenu = ref(false);
const toggleMenu = ref(false);
const classImg = ref("img-normal");
const padraoParaConsulta = 750;
const props = defineProps({
  title: String,
});

const onResize = (e) => {
  width.value = window.innerWidth;
  height.value = window.innerHeight;
};
const checarJanela = () => {
  if (width.value < padraoParaConsulta) {
    ocultaMenu.value = false;
    toggleMenu.value = false;
    classImg.value = "img-expandir";
  } else {
    ocultaMenu.value = true;
    toggleMenu.value = false;
    classImg.value = "img-normal";
  }
};
const toggleMenuAction = () => {
  toggleMenu.value = !toggleMenu.value;
};
const Mounted = onMounted(() => {
  width.value = window.innerWidth;
  height.value = window.innerHeight;
  checarJanela();
  window.addEventListener("resize", onResize);
});

const watch = watchEffect(() => {
  if (width.value) {
    checarJanela();
  }
});
</script>
<style lang="scss" src="@/Assets/Styles/NavPrincipalHome.scss" scoped></style>
<template>
  <div class="nav-principal-principal">
    <span
      v-if="!ocultaMenu"
      class="material-symbols-outlined botao-menu"
      @click="toggleMenuAction"
    >
      menu
    </span>
    <Transition name="slide-fade">
      <nav v-if="toggleMenu && !ocultaMenu">
        <ul>
          <li class="menu-padrao" v-for="(item, index) in $page.props.menus" :key="index">
            <LinkPadrao :descricao="item.descricao" :link="item.rota" />
          </li>
        </ul>
      </nav>
    </Transition>
    <div class="conteiner nav-principal">
      <img :class="classImg" src="/storage/img/Animacao.gif" alt="" sizes="" srcset="" />
      <nav v-if="ocultaMenu">
        <ul>
          <li class="menu-padrao" v-for="(item, index) in $page.props.menus" :key="index">
            <LinkPadrao :descricao="item.descricao" :link="item.rota" />
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>
