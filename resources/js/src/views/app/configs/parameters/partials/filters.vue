<template>
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-recent-orders">
      <div class="widget-heading">
        <h5>Filters</h5>
      </div>
      <div class="widget-content table-responsive">
        <Search :search="data.search" @onSearch="generateReport" />
      </div>
    </div>
  </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { defineEmits, reactive, onMounted } from "vue";
import Search from "@/components/common/search.vue";
const emit = defineEmits(["genarateReportData"]);

const props = defineProps({
  filters: { type: Object, require: false,default: {search:null}  },
});

onMounted(() => {
    data.search = props.filters.search ? props.filters.search : null;
});

const data = reactive({
    search:  null,
});

const generateReport = (dataSearch) => {
  emit("genarateReportData", dataSearch);
};
</script>
