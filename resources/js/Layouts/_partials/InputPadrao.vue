<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  descricao: String,
  classes: Array,
});

const emit = defineEmits(["action"]);
const action = () => {
  emit("action");
};
</script>
<style lang="scss" src="@/Assets/Styles/PartialsLayout.scss"></style>
<template>
  <button class="botao-padrao" :class="classes" @click="action">
    <i class="fa-thin fa-heart" aria-hidden="true"></i>{{ descricao }}
  </button>
</template>
