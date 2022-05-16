<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
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
  <a class="link-img" :href="link" :target="target" rel="noopener noreferrer"  @click="action">
      <img :class="classes" :src="'/storage/img/'+icone" alt="" sizes="" srcset="" />
  </a>
</template>
