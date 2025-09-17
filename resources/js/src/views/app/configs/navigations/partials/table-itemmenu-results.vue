<template>
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-recent-orders">
      <div class="widget-heading">
        <h5>Menu: {{props.dataReport.name}} - List Menu Items</h5>
        <FormItemMenuModal
          v-if="data.addItemMenu"
          :typeModeUpdate="data.typeModeUpdate"
          :dataItem="data.editItem"
          :menu="data.addItemMenu"
          :routes="props.routes"
          @closedModal="closeItemModal"
        />
        <FormSubitemModal
          v-if="data.addSubitem"
          :typeModeUpdate="data.typeModeUpdate"
          :dataItem="data.editItem"
          :menu="data.addSubitem"
          :routes="props.routes"
          @closedModal="closeItemModal"
        />
       <div>
        <button
          v-if="!data.typeModeUpdate"
          type="button"
          class="btn btn-dark"
          @click="addItemModal(props.dataReport)"
        >
          <span>Add</span>
        </button>
        <button
          type="button"
          class="btn btn-danger ms-3"
          @click="closedRel()"
        >
          <span>Fechar</span>
        </button>
       </div>
      </div>
      <div class="widget-content table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-left">Description</th>
              <th class="text-left">Route</th>
              <th class="text-center" style="min-width:150px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in props.dataReport.menuItems" :key="item.id">
              <td class="text-center">{{ item.id_update }}</td>
              <td class="text-left">{{ item.name }}</td>
              <td class="text-left">{{ item.route }}</td>
              <td class="text-center">
                <button
                  type="button"
                  class="btn btn-info ms-3"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Add Subitem Menu"
                  data-original-title="View"
                  @click="addSubitemModal(item)"
                >
                  <span><i class="fa-solid fa-bars"></i></span>
                </button>
                <button
                  type="button"
                  class="btn btn-info ms-3"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Mostrar Item Menu"
                  data-original-title="View"
                  @click="showItemsMenu(item)"
                >
                  <span><i class="fa-solid fa-eye"></i></span>
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
import FormItemMenuModal from "./form-itemmenu-modal.vue";
import FormSubitemModal from "./form-subitem-modal.vue";
import { defineProps, reactive,defineEmits } from "vue";
const emit = defineEmits(["closedRel","showItemsMenu"]);
const data = reactive({
  editItem: {},
  typeModeUpdate: "",
  addItemMenu: "",
  addSubitem: "",
});

const openModal = (mode = "add", item = {}) => {
  data.editItem = item;
  data.typeModeUpdate = mode;
};

const addItemModal = (menu) => {
  data.addItemMenu = menu;
  data.typeModeUpdate = "add_item";
};

const addSubitemModal = (menu) => {
  data.addSubitem = menu;
  data.typeModeUpdate = "add_subitem";
};

const closeModal = () => {
  data.editItem = {};
  data.typeModeUpdate = "";
};

const closeItemModal = () => {
  data.addItemMenu = "";
  closedRel();
};

const props = defineProps({
  dataReport: { type: Object, require: false, default: { data: [] } },
  routes: { type: Object, require: false, default: { data: [] } },
});

const showProcess = (dataProcess) => {
  process.value = dataProcess;
};

const showItemsMenu = (item) => {
  emit("showItemsMenu", item);
};

const closedRel = () => {
  emit("closedRel");
};

const deleteItem = (item) => {
  const swalWithBootstrapButtons = window.Swal.mixin({
    confirmButtonClass: "btn btn-secondary",
    cancelButtonClass: "btn btn-dark me-3",
    buttonsStyling: false,
  });

  swalWithBootstrapButtons
    .fire({
      title: "Are you sure you want to delete this menu?",
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
          route("app.navigations.itemmenu.delete"),
          { id: item.id_update },
          {
            preserveState: true,
            onSuccess: () => {
              swalWithBootstrapButtons.fire(
                "Menu has been successfully deleted.",
                "The menu has been successfully deleted.",
                "success"
              );
              closedRel();
            },
            onError: () => {
              swalWithBootstrapButtons.fire(
                "Canceled",
                "Error deleting menu",
                "error"
              );
            },
          }
        );
      }
    });
};
</script>
