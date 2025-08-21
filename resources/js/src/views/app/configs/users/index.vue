<template>
  <ContentLayout :title="name" :descriptionCurrentPage="name" :linksBreadcrumb="[]">
    <Filters
      :filters="props.filters"
      @genarateReportData="genarateReport"
    />
    <TableResults :dataReport="props.reports" />
  </ContentLayout>
</template>
<script setup>
import { Inertia } from "@inertiajs/inertia";
import { computed, ref, reactive, onMounted } from "vue";
import { useStore } from "vuex";
import { useMeta } from "@/composables/use-meta";

import Filters from "./partials/filters.vue";
import TableResults from "./partials/table-results.vue";

import ContentLayout from "@/layouts/content-layout.vue";

const name = "Users";
useMeta({ title: name });
onMounted(() => {});
const props = defineProps({
    filters: { type: Object, require: false },
    reports: { type: Object, require: false },
});

const genarateReport = (dataSearch) => {
  Inertia.get(route("app.users.index"), { search: dataSearch },{ replace: true, preserveState: true });
};
</script>
