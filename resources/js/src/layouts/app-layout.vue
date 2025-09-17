<template>
  <div :class="[$store.state.layout_style, $store.state.menu_style]">
    <component v-bind:is="layout"></component>
    <!--  BEGIN NAVBAR  -->
    <Header>
      <template #breadcrumb>
        <slot name="breadcrumb"></slot>
      </template>
    </Header>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div
      class="main-container"
      id="container"
      :class="[
        !$store.state.is_show_sidebar ? 'sidebar-closed sbar-open' : '',
        $store.state.menu_style === 'collapsible-vertical'
          ? 'collapsible-vertical-mobile'
          : '',
      ]"
    >
      <!--  BEGIN OVERLAY  -->
      <div
        class="overlay"
        :class="{ show: !$store.state.is_show_sidebar }"
        @click="$store.commit('toggleSideBar', !$store.state.is_show_sidebar)"
      ></div>
      <div
        class="search-overlay"
        :class="{ show: $store.state.is_show_search }"
        @click="$store.commit('toggleSearch', !$store.state.is_show_search)"
      ></div>
      <!-- END OVERLAY -->

      <!--  BEGIN SIDEBAR  -->
      <Sidebar></Sidebar>
      <!--  END SIDEBAR  -->

      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
        <slot></slot>

        <!-- BEGIN FOOTER -->
        <Footer></Footer>
        <!-- END FOOTER -->
      </div>
      <!--  END CONTENT AREA  -->

      <!-- BEGIN APP SETTING LAUNCHER -->
      <app-settings />
      <!-- END APP SETTING LAUNCHER -->
    </div>
  </div>
</template>

<script setup>
import Header from "@/components/layout/header.vue";
import Sidebar from "@/components/layout/sidebar.vue";
import Footer from "@/components/layout/footer.vue";
import appSettings from "@/components/app-settings.vue";
import { computed,onMounted } from "vue";
import {usePage} from "@inertiajs/vue3";

import "@/assets/sass/app.scss";

import { useMeta } from "@/composables/use-meta";
import { useStore } from "vuex";
const props = defineProps({
  title: { type: String, require: false },
});
const page = usePage()
const app_name = computed(() => (page.props?.value?.app_name ?? page.props?.app_name ?? 'Laravel'))
useMeta({ title: `${app_name.value} ${props.title ? "| " + props.title : ""}` });

const store = useStore();

const layout = computed(() => {
  return store.getters.layout;
});

</script>
