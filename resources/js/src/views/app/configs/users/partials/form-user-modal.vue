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
          <h4 class="modal-title">User</h4>
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
              placeholder="User Name"
            />
          </div>
          <div v-if="data.erros" class="text-danger">{{ data.erros.name }}</div>

          <label for="descripts" class="form-label mt-3">Email</label>
          <div class="input-group">
            <input
              v-model="data.email"
              type="email"
              class="form-control"
              id="descripts"
              aria-describedby="basic-addon3"
              placeholder="User Email"
            />
          </div>
          <div v-if="data.erros" class="text-danger">{{ data.erros.email }}</div>
            <label for="update-password" class="form-label mt-3">Change Password</label>
          <div class="input-group">
            <input
              v-model="data.password"
              type="password"
              class="form-control"
              id="update-password"
              placeholder="New Password"
            />
          </div>
            <label for="confirm-update-password" class="form-label mt-3">Confirm Password</label>
          <div class="input-group">
            <input
              v-model="data.password_confirmation"
              type="password"
              class="form-control"
              id="confirm-update-password"
              placeholder="Confirm Password"
            />
          </div>

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
            <span>When changing the user remember to advise the same.</span>
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
      name: "",
      email: "",

    },
  },
});
const validPassword = () => {
  return data.password === data.password_confirmation;
};
onMounted(() => {
  if (props.typeModeUpdate === "edit") {
    data.id = props.dataItem.id;
    data.name = props.dataItem.name;
    data.email = props.dataItem.email;
  }
  document.getElementById("openModal").click();
});

const closeModal = () => {
  data.id = "";
  data.name = "";
  data.email = "";
  data.password = "";
  data.password_confirmation = "";
  data.erros = null;
  emit("closedModal");
};

const data = reactive({
  erros: null,
  id: "",
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  form: useForm({
    id: "",
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
  }),
});

const addHeader = () => {
  data.erros = {};

  if (data.name == "")
    Object.assign(data.erros, {
      name: "The name field is required.",
    });

  if (data.email == "")
    Object.assign(data.erros, {
      email: "The Email field is required.",
    });

  if (validPassword() == false)
    Object.assign(data.erros, {
      password: "Passwords do not match.",
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

  data.form.id = data.id;
  data.form.name = data.name;
  data.form.email = data.email;
  data.form.password = data.password;
  data.form.password_confirmation = data.password_confirmation;

  if (props.typeModeUpdate === "edit") {
    data.form.post(route("app.users.update"), {
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

  if (props.typeModeUpdate === "add") {
    data.form.post(route("app.users.store"), {
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
          alert += item;
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
