<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th><div class="th-content">Automation</div></th>
          <th><div class="th-content">Processes</div></th>
          <th><div class="th-content">Start</div></th>
          <th><div class="th-content th-heading">End</div></th>
          <th><div class="th-content">Status</div></th>
          <th><div class="th-content">Action</div></th>
        </tr>
      </thead>
      <tbody>
        <tr v-show="data.idActivity == null || data.idActivity == item.id" v-for="item in props.dataActions.data" :key="item.id" :item="item" >
          <td>
            <div class="td-content">{{ item.automation.name }}</div>
          </td>
          <td>
            <div class="td-content text-primary">{{ item.process.length }}</div>
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
            <td>
                <button v-if="data.idActivity == null"
                    class="btn btn-success"
                    @click="showProcess(item)"
                >
                    Processes
                </button>
                <button v-else
                    class="btn btn-primary"
                    @click="closeProcess()"
                >
                    Close Processes
                </button>
                <Link
                    :href="route('app.reports.monitoring-automations.process',item.id)"
                    class="btn btn-primary ms-2">
                    <span>
                        <i class="fa fa-eye"></i>
                    </span>
                    </Link>

            </td>
        </tr>
      </tbody>
    </table>
    <TableProcess v-if="data.processData.data != null" :dataProcess=" data.processData" />
  </div>
</template>
<script setup>
import {Link,usePage} from "@inertiajs/vue3";
import { computed, ref, reactive, onMounted } from "vue";
import TableProcess from "@/components/common/table-process.vue";
const props = defineProps({
  dataActions: {
    type: Object,
    require: false,
    default: () => {
      data: [];
    },
  },
});
onMounted(() => {});
const name = "table-actions";
const data = reactive({
  idActivity: null,
  processData: {data:null},
});
const showProcess = (item) => {
    data.idActivity = item.id;
    data.processData.data = item.process;
};
const closeProcess = () => {
    data.idActivity = null;
    data.processData.data = null;
};
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
