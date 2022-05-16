<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  descricao: String,
  classes: Array,
  icone:String,
});

const emit = defineEmits(["action"]);
const action = () => {
  emit("action");
};
</script>
<style lang="scss" src="@/Assets/Styles/PartialsLayout.scss" scoped></style>
<template>
  <button class="botao-padrao" :class="classes" @click="action">
    <i class="material-symbols-outlined" aria-hidden="true">{{icone}}</i><div>{{ descricao }}</div>
  </button>
</template>
