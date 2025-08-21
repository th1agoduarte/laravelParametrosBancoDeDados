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
          <h4 class="modal-title">Parameter</h4>
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
          <label for="descripts" class="form-label">Description</label>
          <div class="input-group">
            <input
              v-model="data.description"
              @keyup="setKey()"
              type="text"
              class="form-control"
              id="descripts"
              aria-describedby="basic-addon3"
              placeholder="Parameter Description"
            />
          </div>
          <div v-if="data.erros" class="text-danger">{{ data.erros.description }}</div>

          <label for="value-field" class="form-label mt-3">Value</label>
          <div class="input-group">
            <input
              v-model="data.value"
              type="text"
              class="form-control"
              id="value-field"
              aria-describedby="basic-addon3"
              placeholder="Value for the Parameter"
            />
          </div>
          <div v-if="data.erros" class="text-danger">{{ data.erros.value }}</div>
          <div class="form-check form-switch">
            <input
              class="form-check-input"
              type="checkbox"
              id="show-pass"
              @change="toggleShowPassword()"
            />
            <label class="form-check-label" for="show-pass"
              >Value of should be secret?</label
            >
          </div>

          <label for="descripts" class="form-label mt-3">Comment</label>
          <div class="input-group">
            <textarea
              v-model="data.comment"
              type="text"
              class="form-control"
              id="descripts"
              aria-describedby="basic-addon3"
              placeholder="Comment on the Parameter"
            ></textarea>
          </div>
          <div v-if="data.erros" class="text-danger">{{ data.erros.comment }}</div>

          <label for="key" class="form-label mt-3">Parameter</label>
          <div class="input-group">
            <input
              v-model="data.parameter"
              type="text"
              class="form-control"
              id="key"
              aria-describedby="basic-addon3"
              placeholder="key"
              :disabled="true"
            />
          </div>
          <div v-if="data.erros" class="text-danger">{{ data.erros.parameter }}</div>
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
            <span>Be careful when changing a parameter, it can cause system failures</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive, defineEmits, onMounted } from "vue";

import "@/assets/sass/components/custom-sweetalert.scss";

import "@/assets/sass/scrollspyNav.scss";

const emit = defineEmits(["addHeader,closedModal"]);
const name = "form-parameter-modal";

const toggleShowPassword = () => {
  const passwordInput = document.querySelector("#value-field");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    data.type_secret = "N";
  } else {
    passwordInput.type = "password";
    data.type_secret = "Y";
  }
};

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
      description: "",
      value: "",
      comment: "",
      parameter: "",
      type_secret: "N",
    },
  },
});

onMounted(() => {
  if (props.typeModeUpdate === "edit") {
    data.id = props.dataItem.id;
    data.description = props.dataItem.description;
    data.value = props.dataItem.value;
    data.comment = props.dataItem.comment;
    data.parameter = props.dataItem.parameter;
    data.type_secret = props.dataItem.type_secret;
    if (props.dataItem.type_secret == "Y"){
        let input = document.querySelector("#show-pass");
        input.checked = true;
        toggleShowPassword();
    }
  }
  document.getElementById("openModal").click();
});

const closeModal = () => {
  data.id = "";
  data.description = "";
  data.value = "";
  data.comment = "";
  data.parameter = "";
  data.erros = null;
  data.type_secret = "N";
  emit("closedModal");
};

const data = reactive({
  erros: null,
  description: "",
  value: "",
  comment: "",
  parameter: "",
  id: "",
  type_secret: "N",
  form: useForm({
    description: "",
    value: "",
    comment: "",
    parameter: "",
    type_secret: "N",
    id: "",
  }),
});

const setKey = () => {
  data.parameter = data.description.replace(/,?\s+/g, "_").toUpperCase();
  data.parameter = data.parameter.replace(/[ÀÁÂÃÄÅàáâãäå]/g, "a");
  data.parameter = data.parameter.replace(/[ÈÉÊËèéêë]/g, "e");
  data.parameter = data.parameter.replace(/[ÌÍÎÏìíîï]/g, "i");
  data.parameter = data.parameter.replace(/[ÒÓÔÕÖòóôõö]/g, "o");
  data.parameter = data.parameter.replace(/[ÙÚÛÜùúûü]/g, "u");
  data.parameter = data.parameter.replace(/[Çç]/g, "c");
  data.parameter = data.parameter.replace(/[Ññ]/g, "n");
  data.parameter = data.parameter.replace(/[ÝýÿŸ]/g, "y");
  data.parameter = data.parameter.replace(/[žŽ]/g, "z");
  data.parameter = data.parameter.replace(/[\(\)]/g, "");
};

const addHeader = () => {
  data.erros = {};

  if (data.description == "")
    Object.assign(data.erros, {
      description: "The Description field is mandatory.",
    });

  if (data.parameter == "")
    Object.assign(data.erros, {
      parameter: "The Parameter field is mandatory.",
    });

  if (Object.keys(data.erros).length > 0) {
    new window.Swal({
      icon: "error",
      title: "invalid form!",
      text: "Make sure all fields are filled in correctly!",
      padding: "2em",
    });
    return;
  }

  data.form.description = data.description;
  data.form.value = data.value;
  data.form.comment = data.comment;
  data.form.parameter = data.parameter;
  data.form.id = data.id;
  data.form.type_secret = data.type_secret;

  if (props.typeModeUpdate === "edit") {
    data.form.post(route("app.parameters.update"), {
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
    data.form.post(route("app.parameters.store"), {
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
