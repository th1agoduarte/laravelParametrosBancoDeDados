<template>
    <div class="paginating-container pagination-solid flex-column align-items-center">
    <ul v-if="props.data.links" role="menubar" aria-disabled="false" aria-label="Pagination" class="pagination mb-4 rounded b-pagination">
        <li role="presentation" class="page-item first">
            <Link :href="mountUrl(props.data.links.first)" role="menuitem" type="button" tabindex="-1" aria-label="Go to first page" class="page-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
            </Link>
        </li>
        <li v-if="props.data.links.prev" role="presentation" class="page-item prev">
            <Link :href="mountUrl(props.data.links.prev)" role="menuitem" type="button" tabindex="-1" aria-label="Go to previous page" class="page-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </Link>
        </li>
        <li
            :class="{ active: item.active }"
              v-for="item in formatLinks"
              :key="item"
            role="presentation" class="page-item">
            <Link :href="mountUrl(item.url)" role="menuitemradio" type="button" aria-label="Go to page 1" aria-checked="false" aria-posinset="1" aria-setsize="3" tabindex="-1" class="page-link">
                {{ item.label }}
            </Link>
        </li>
        <li v-if="props.data.links.next" role="presentation" class="page-item next">
            <Link :href="mountUrl(props.data.links.next)" role="menuitem" type="button" tabindex="-1" aria-label="Go to next page" class="page-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </Link>
        </li>
        <li role="presentation" class="page-item last">
            <Link :href="mountUrl(props.data.links.last)" role="menuitem" type="button" tabindex="-1" aria-label="Go to last page" class="page-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                </svg>
            </Link>
        </li>
    </ul>
</div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
const props = defineProps({
  data: Object,
  search: String,
  perPage: String,
  pageName: String,
});
const links = ref("TEste");
const formatLinks = computed({
  get() {
    const linkstratar = [...props.data.meta.links];
    linkstratar.shift();
    linkstratar.pop();
    links.value = linkstratar;
    return links.value;
  },
});
const parameterUrl = (paramsUrl) => {
  let parameters = "";
  Object.keys(paramsUrl).forEach(function (item) {
    if (paramsUrl[item] != "") parameters += "&" + item + "=" + paramsUrl[item];
  });
  return parameters;
};
const mountUrl = (defaultValue) => {
  let paramsUrl = route().params;
  delete paramsUrl.page;

  let url = "";
  if (props.pageName != "" && props.pageName != undefined && typeof defaultValue == "string") {
    defaultValue = defaultValue.replace("page", props.pageName);
  }

  url +=
    props.perPage != "" && props.perPage != undefined ? "&perPage=" + props.perPage : "";
  url += parameterUrl(paramsUrl);

  return defaultValue + url;
};

</script>

