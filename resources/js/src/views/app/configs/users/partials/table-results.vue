<template>
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-recent-orders">
      <div class="widget-heading">
        <h5>Users</h5>
        <FormUsersModal
          v-if="data.typeModeUpdate"
          :typeModeUpdate="data.typeModeUpdate"
          :dataItem="data.editItem"
          @closedModal="closeModal"
        />
        <button
          v-if="!data.typeModeUpdate"
          type="button"
          class="btn btn-dark"
          @click="openModal('add', null)"
        >
          <span>Add</span>
        </button>
      </div>
      <div class="widget-content table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="text-center"><div class="th-content">Avatar</div></th>
              <th class="text-center"><div class="th-content">ID</div></th>
              <th class="text-left"><div class="th-content">User</div></th>
              <th class="text-left"><div class="th-content">Email</div></th>
              <th class="text-center"><div class="th-content">Actions</div></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in props.dataReport.data" :key="item.id">
              <td class="text-center">
                <div class="td-content">
                  <img
                    v-if="item.photo && item.photo !== '/storage/'"
                    :src="item.photo"
                    alt="profile"
                    class="profile-preview"
                  />
                  <img
                    v-else
                    :src="`https://ui-avatars.com/api/?name=${item.name}&color=7F9CF5&background=EBF4FF`"
                    alt="profile"
                    class="profile-preview"
                  />
                </div>
              </td>
              <td class="text-center"><div class="td-content">{{ item.id }}</div></td>
              <td class="text-left"><div class="td-content">{{ item.name }}</div></td>
              <td class="text-left"><div class="td-content">{{ item.email }}</div></td>
              <td class="text-center">
                <button
                  type="button"
                  class="btn btn-info"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Editar Configurações"
                  data-original-title="View"
                  @click="openModal('edit', item)"
                >
                  <span><i class="fa-regular fa-pen-to-square"></i></span>
                </button>
                <button
                  type="button"
                  class="btn btn-danger ms-3"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Excluir Configurações"
                  data-original-title="View"
                  @click="deleteItem(item)"
                >
                  <span><i class="fa-regular fa-trash-can"></i></span>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <Paginate
          :data="props.dataReport"
          :search="null"
          :perPage="null"
          :pageName="null"
        />
      </div>
    </div>
  </div>
</template>
<script setup>
import { router } from "@inertiajs/vue3";
import Paginate from "@/components/common/paginate.vue";
import FormUsersModal from "./form-user-modal.vue";
import { defineProps, reactive } from "vue";
const data = reactive({
  editItem: {},
  typeModeUpdate: "",
});

const openModal = (mode = "add", item = {}) => {
  data.editItem = item;
  data.typeModeUpdate = mode;
};

const closeModal = () => {
  data.editItem = {};
  data.typeModeUpdate = "";
};

const props = defineProps({
  dataReport: { type: Object, require: false, default: { data: [] } },
});

const showProcess = (dataProcess) => {
  process.value = dataProcess;
};

const deleteItem = (item) => {
  const swalWithBootstrapButtons = window.Swal.mixin({
    confirmButtonClass: "btn btn-secondary",
    cancelButtonClass: "btn btn-dark me-3",
    buttonsStyling: false,
  });

  swalWithBootstrapButtons
    .fire({
      title: "Are you sure you want to delete this user?",
      text: "You will not be able to reverse this operation!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, Delete!",
      cancelButtonText: "No",
      reverseButtons: true,
      padding: "2em",
    })
    .then((result) => {
      if (result.value) {
        router.post(
          route("app.users.delete"),
          { id: item.id },
          {
            preserveState: true,
            onSuccess: () => {
              swalWithBootstrapButtons.fire(
                "Automation file has been successfully deleted.",
                "The user has been successfully deleted.",
                "success"
              );
            },
            onError: () => {
              swalWithBootstrapButtons.fire(
                "Canceled",
                "Error deleting user",
                "error"
              );
            },
          }
        );
      }
    });
};
</script>
