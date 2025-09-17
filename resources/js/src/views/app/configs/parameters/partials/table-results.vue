<template>
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-recent-orders">
      <div class="widget-heading">
        <h5>Parameters</h5>
        <FormParameterModal
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
        <table class="table">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-left">Parameter</th>
              <th class="text-left">Description</th>
              <th class="text-left">Comment</th>
              <th class="text-left">Value</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in props.dataReport.data" :key="item.id">
              <td class="text-center">{{ item.id }}</td>
              <td class="text-left">{{ item.parameter }}</td>
              <td class="text-left">{{ item.description }}</td>
              <td class="text-left">{{ item.comment }}</td>
              <td class="text-left" v-if="item.type_secret == 'N'">{{ item.value }}</td>
              <td class="text-left" v-else> *** </td>
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
import { router } from '@inertiajs/vue3';
import Paginate from "@/components/common/paginate.vue";
import FormParameterModal from "./form-parameter-modal.vue";
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
      title: "Tem certeza que quer excluir esse parâmetro?",
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
          route("app.parameters.delete"),
          { id: item.id },
          {
            preserveState: true,
            onSuccess: () => {
              swalWithBootstrapButtons.fire(
                "Automation file has been successfully deleted.",
                "O parâmetro foi deletado com sucesso.",
                "success"
              );
            },
            onError: () => {
              swalWithBootstrapButtons.fire(
                "Canceled",
                "Erro ao Excluir o parâmetro)",
                "error"
              );
            },
          }
        );
      }
    });
};
</script>
