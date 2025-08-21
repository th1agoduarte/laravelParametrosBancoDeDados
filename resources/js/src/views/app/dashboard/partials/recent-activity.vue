<template>
  <div :class="`item-timeline timeline-${statusBadge}`">
    <div :class="`badge badge-${statusBadge}`"></div>
    <div :class="`t-text`">
      <p>{{ description }}</p>
      <span :class="`badge badge-outline-${statusBadge} outline-badge-${statusBadge} icon-fill-${statusBadge}`">{{statusDescription}}</span>
      <p :class="`t-time`">{{time}}</p>
    </div>
  </div>
</template>
<script setup>
import { computed, ref,reactive,onMounted } from 'vue';
const props = defineProps({
  description: { type: String, require: true },
  status: { type: Number, require: false, default: 0 },
  time: { type: String, require: false, default: 0 },
});
onMounted(() => {

});
const name = "recent-activity";

const statusDescription = computed(() => {
  if (props.status == 0) {
    return "Running";
  } else if (props.status == 1) {
    return "Success";
  } else if (props.status == 2) {
    return "Fail";
  }
});

const statusBadge = computed(() => {
  if (props.status == 0) {
    return "primary";
  } else if (props.status == 1) {
    return "success";
  } else if (props.status == 2) {
    return "danger";
  }
});

</script>
