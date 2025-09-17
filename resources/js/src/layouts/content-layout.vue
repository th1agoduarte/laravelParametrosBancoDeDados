<template>
  <AppLayout :title="props.title">
    <template #breadcrumb>
      <Breadcrumb
        :descriptionCurrentPage="props.descriptionCurrentPage"
        :links="props.linksBreadcrumb"
      />
    </template>
    <div class="layout-px-spacing dash_1">
      <div class="row layout-top-spacing">
        <slot></slot>
      </div>
    </div>
  </AppLayout>
</template>
<script setup>
import AppLayout from "@/layouts/app-layout.vue";
import Breadcrumb from "@/components/layout/breadcrumb.vue";
import { router } from "@inertiajs/vue3";
import { computed, ref, reactive, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import "@/assets/sass/widgets/widgets.scss";
const name = "content layout";
const props = defineProps({
  title: { type: String, require: false },
  descriptionCurrentPage: { type: String, require: false },
  linksBreadcrumb: { type: Array, require: false },
});

onMounted(() => {
  if (usePage().props.flash.permissionErro) {
    new window.Swal({
      icon: "warning",
      title: "Permissions",
      text: usePage().props.flash.permissionErro,
      padding: "2em",
    });
  }
});
</script>
