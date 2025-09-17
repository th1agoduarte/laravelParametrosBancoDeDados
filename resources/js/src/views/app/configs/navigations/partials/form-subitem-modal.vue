<template>
  <!-- Button trigger modal -->
  <button
    id="openModal"
    type="button"
    class="btn"
    :class="props.editMode ? 'btn-info' : 'btn-dark me-2'"
    data-bs-toggle="modal"
    data-bs-target="#formParameterModal"
  >
    <span>Add</span>
  </button>

  <div
    class="modal fade"
    id="formParameterModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="formParameterModalLabel"
    aria-hidden="false"
    data-bs-backdrop="static"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" id="formParameterModalLabel">
          <h4 class="modal-title">Menu Item: {{props.menu.name}} - Menu sub-item</h4>
          <button
            type="button"
            data-dismiss="modal"
            data-bs-dismiss="modal"
            aria-label="Close"
            class="btn-close"
            @click="closeModal"
          ></button>
        </div>
        <div class="modal-body">
          <label for="descripts" class="form-label">Name</label>
          <div class="input-group">
            <input
              v-model="data.name"
              type="text"
              class="form-control"
              id="descripts"
              aria-describedby="basic-addon3"
              placeholder="Main Menu Name"
            />
          </div>
          <div v-if="data.erros" class="text-danger">{{ data.erros.name }}</div>

          <div v-if="data.erros" class="text-danger">{{ data.erros.icon }}</div>

          <label for="route" class="form-label mt-3">Rota</label>
          <div class="input-group">
            <select v-model="data.route" id="route" class="form-select">
            <option value="" selected>Menu with Items...</option>
            <option
                v-for="item in props.routes"
                :key="item"
                :value="item.action.as"
            >
                {{ item.action.as }} / {{item.uri}}
            </option>
            </select>
          </div>
          <div v-if="data.erros" class="text-danger">{{ data.erros.route }}</div>
          <button
            v-if="data.id"
            type="button"
            class="btn btn-primary mt-3"
            @click="addHeader()"
          >
            Save
          </button>

          <button v-else type="button" class="btn btn-primary mt-3" @click="addHeader()">
            Save
          </button>
        </div>
        <div class="modal-footer justify-content-center">
          <div class="forgot login-footer">
            <span>This menu sub-item will be added to the Menu Item</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { reactive, defineEmits, onMounted } from "vue";

import "@/assets/sass/components/custom-sweetalert.scss";

import "@/assets/sass/scrollspyNav.scss";

const emit = defineEmits(["addHeader,closedModal"]);
const name = "form-parameter-modal";

const props = defineProps({
  typeModeUpdate: {
    type: String,
    required: true,
    default: "add",
  },
  dataItem: {
    type: Object,
    default: {
      id: "",
      menu_item_id: "",
      name: "",
      route: "",
    },
  },
  routes: {
    type: Object,
    default: [],
  },
  menu: {
    type: Object,
    default: [],
  },
});

onMounted(() => {

  if (props.typeModeUpdate === "edit_item") {
    data.id = props.dataItem.id_update;
    data.name = props.dataItem.name;
    data.menu_item_id = props.dataItem.menu_item_id;
    data.route = props.dataItem.route;
  }else{
    data.menu_item_id = props.menu.id_update;
  }
  document.getElementById("openModal").click();
});

const closeModal = () => {
  data.id = "";
  data.name = "";
  data.menu_item_id = "";
  data.route = "";
  emit("closedModal");
};

const data = reactive({
  erros: null,
  name: "",
  menu_item_id: "",
  route: "",
  id: "",
  form: useForm({
    name: "",
    route: "",
    menu_item_id: "",
    id: "",
  }),
});

const addHeader = () => {
  data.erros = {};

  if (data.name == "")
    Object.assign(data.erros, {
      name: "The name field is required.",
    });

    if (data.route == "")
    Object.assign(data.erros, {
      route: "The Route field is required.",
    });

  if (Object.keys(data.erros).length > 0) {
    new window.Swal({
      icon: "error",
      title: "Invalid form!",
      text: "Make sure all fields are filled in correctly!",
      padding: "2em",
    });
    return;
  }

  data.form.name = data.name;
  data.form.menu_item_id = data.menu_item_id;
  data.form.route = data.route;
  data.form.id = data.id;
  if (props.typeModeUpdate === "edit_item") {
    data.form.post(route("app.navigations.subitem.update"), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: (page) => {
        new window.Swal({
          icon: "success",
          title: "Update successfully completed!",
          text: "The data has been updated successfully!",
          padding: "2em",
        });
      },
      onError: (errors) => {
        let alert = "";
        Object.keys(errors).forEach((item) => {
          alert += `\n${item} -> ${errors[item]}`;
        });
        new window.Swal({
          icon: "error",
          title: "Error performing update!",
          text: alert,
          padding: "2em",
        });
      },
    });
  }

  if (props.typeModeUpdate === "add_subitem") {
    data.form.post(route("app.navigations.subitem.store"), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: (page) => {
        new window.Swal({
          icon: "success",
          title: "Registration successful!",
          text: "The data has been registered successfully!",
          padding: "2em",
        });
      },
      onError: (errors) => {
        let alert = "";
        Object.keys(errors).forEach((item) => {
          alert += `\n${item} -> ${errors[item]}`;
        });
        new window.Swal({
          icon: "error",
          title: "Error when registering!",
          text: alert,
          padding: "2em",
        });
      },
    });
  }

  document.querySelector(".btn-close").click();
};
</script>
