<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  contatos: Object,
});
</script>
<style lang="scss" src="@/Assets/Styles/ContatoUnidade.scss" scoped></style>
<template>
  <div class="contato">
    <h3>
      <strong>{{ contatos.unidade }}</strong>
    </h3>
    <div class="contato-numero">
      <p v-for="(item, index) in contatos.contatos" :key="index">{{ item.contato }}</p>
    </div>
    <p v-for="(item, index) in contatos.enderecos" :key="index" class="contato-endereco">
      {{ item.endereco }}
    </p>
  </div>
</template>
