<template>
    <ContentLayout :title="name" :descriptionCurrentPage="name" :linksBreadcrumb="[]">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                ok
            </div>
        </div>
    </ContentLayout>
  </template>
  <script setup>
  import { router } from "@inertiajs/vue3";
  import { computed, ref,reactive,onMounted } from 'vue';
  import { useStore } from 'vuex';
  import { useMeta } from "@/composables/use-meta";

  import ContentLayout from "@/layouts/content-layout.vue";


  const name = "Dashboard";
  useMeta({ title: name });
  onMounted(() => {});
  const store = useStore();
  const props = defineProps({
  });



  </script>
