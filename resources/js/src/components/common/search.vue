<template>
  <div class="form-group col-md-3">
    <label for="search">Search</label>
    <input
      type="text"
      class="form-control"
      id="search"
      placeholder="Search"
      :value="props.search"
      @update:dataSearch="dataSearch.value = $event"
      @keyup="execSearch($event.target.value)"
    />
  </div>
</template>
<script setup>
import { defineEmits, ref } from "vue";
const name = "Search-imput";
const emit = defineEmits(["onSearch"]);
const props = defineProps({
  search: { type: String, require: false },
});
const execSearch = (dataSearch) => {
  emit("onSearch", dataSearch);
};
</script>
