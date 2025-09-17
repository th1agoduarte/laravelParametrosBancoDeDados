<template>
  <ContentLayout :title="name" :descriptionCurrentPage="name" :linksBreadcrumb="[]">
    <!-- <Filters
      :filters="props.filters"
      @genarateReportData="genarateReport"
    /> -->
    <TableResults v-if="!data.itensMenu && !data.subiten" :dataReport="props.reports" :routes="props.routes" @showItemsMenu="showItemsMenu" />
    <TableItemmenuResults v-if="data.itensMenu && !data.subiten" :dataReport="data.itensMenu" :routes="props.routes" @closedRel="closedRel" @showItemsMenu="showSubitems"/>
    <TableSubitemsResults v-if="data.subiten" :dataReport="data.subiten" :routes="props.routes" @closedRel="closedSubitems"/>
  </ContentLayout>
</template>
<script setup>
import { router } from "@inertiajs/vue3";
import { computed, ref, reactive, onMounted } from "vue";
import { useStore } from "vuex";
import { useMeta } from "@/composables/use-meta";

import Filters from "./partials/filters.vue";
import TableResults from "./partials/table-results.vue";
import TableItemmenuResults from "./partials/table-itemmenu-results.vue";
import TableSubitemsResults from "./partials/table-subitems-results.vue";

import ContentLayout from "@/layouts/content-layout.vue";

const name = "Manager Navigation";
useMeta({ title: name });
onMounted(() => {});
const props = defineProps({
    filters: { type: Object, require: false },
    reports: { type: Object, require: false },
    routes: { type: Object, require: false },
});

const data = reactive({
    itensMenu: null,
    subiten: null,
});

const closedRel = () => {
    data.itensMenu = null;
};

const showSubitems = (item) => {
    data.subiten = item;
};

const closedSubitems = () => {
    data.subiten = null;
};


const showItemsMenu = (item) => {
    data.itensMenu = item;
};

const genarateReport = (dataSearch) => {
  router.get(route("app.navigations.index"), { search: dataSearch },{ replace: true, preserveState: true });
};
</script>
