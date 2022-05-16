<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  descricao: String,
  link:String,
  classes: Array,
  icone:String,
  target:String,
});

const emit = defineEmits(["action"]);
const action = () => {
  emit("action");
};
</script>
<style lang="scss" src="@/Assets/Styles/PartialsLayout.scss" scoped></style>
<template>
  <a class="link-botao-padrao" :class="classes" :href="link" :target="target" rel="noopener noreferrer"  @click="action">
      <i class="material-symbols-outlined" aria-hidden="true">{{icone}}</i><div>{{ descricao }}</div>
  </a>
</template>
