<template>
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-recent-orders">
      <div class="widget-heading">
        <h5>Process</h5>
      </div>
      <div class="widget-content table-responsive">
       <table class="table">
          <thead>
            <tr>
              <th><div class="th-content">Description</div></th>
              <th><div class="th-content">Comment</div></th>
              <th><div class="th-content">requested</div></th>
              <th><div class="th-content">Start</div></th>
              <th><div class="th-content th-heading">End</div></th>
              <th><div class="th-content">Status</div></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in props.dataProcess.data" :key="item.id" :item="item">
              <td>
                <div class="td-content">{{ item.description }}</div>
              </td>
              <td>
                <div class="td-content">{{ item.comment }}</div>
              </td>
              <td>
                <div class="td-content text-primary">
                  {{ item.data_received_formatted }}
                </div>
              </td>
              <td>
                <div class="td-content">{{ item.created_at_formatted }}</div>
              </td>
              <td>
                <div class="td-content">
                  <span>{{ item.updated_at_formatted }}</span>
                </div>
              </td>
              <td>
                <div class="td-content">
                  <span :class="`badge badge-${statusBadge(item.status)}`">{{
                    statusDescription(item.status)
                  }}</span>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script setup>
import { computed, ref, reactive, onMounted } from "vue";
const props = defineProps({
  dataProcess: {
    type: Object,
    require: false,
    default: () => {
      data: [];
    },
  },
});
onMounted(() => {

});
const name = "table-process";

const statusDescription = (status) => {
  if (status == 0) {
    return "Running";
  } else if (status == 1) {
    return "Success";
  } else if (status == 2) {
    return "Failed";
  }
};

const statusBadge = (status) => {
  if (status == 0) {
    return "primary";
  } else if (status == 1) {
    return "success";
  } else if (status == 2) {
    return "danger";
  }
};

</script>
