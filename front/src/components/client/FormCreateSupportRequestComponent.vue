<template>
  <form @submit.prevent="create">
    <div class="modal-body">
      <div class="form-group">
        <label>Titulo:</label>
        <input v-model="formData.title" type="text" class="form-control" />
      </div>
      <div class="form-group">
        <label>Tipo:</label>
        <select v-model="formData.type" class="form-control">
          <option selected disabled>Selecione</option>
          <option value="TECHNICAL">Técnico</option>
          <option value="FINANCIAL">Financeiro</option>
          <option value="OTHER">Outros</option>
        </select>
      </div>
      <div class="form-group">
        <label>Urgência:</label>
        <select v-model="formData.urgency" class="form-control">
          <option selected disabled>Selecione</option>
          <option value="LOW">Baixa</option>
          <option value="MEDIUM">Média</option>
          <option value="URGENCY">Alta</option>
        </select>
      </div>
      <div class="form-group">
        <label>Mensagem:</label>
        <textarea
          v-model="formData.message"
          type="text"
          rows="5"
          class="form-control"
        ></textarea>
      </div>
      <div class="form-group">
        <label>Foto 5MB:</label>
        <input type="file" class="form-control" @change="handleFileUpload" />
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit">
        <i class="fa-regular fa-square-plus"></i> Abrir chamado
      </button>
    </div>
  </form>
</template>

<script setup>
import { createSupportRequest } from "@/services/client";
import { useToastr } from "@/services/toastr";
import { ref } from "vue";

const formData = ref({
  title: null,
  type: null,
  urgency: null,
  message: null,
  file: null,
});
const toastr = useToastr();

const handleFileUpload = (event) => {
  const file = event.target.files[0];
  formData.value.file = file || null;
};

const create = () => {
  if (
    formData.value.title == null ||
    formData.value.title == "" ||
    formData.value.type == null ||
    formData.value.type == "" ||
    formData.value.urgency == null ||
    formData.value.urgency == "" ||
    formData.value.message == null ||
    formData.value.message == ""
  ) {
    toastr.error(
      "Preencha todos os campos corretamente para abrir seu chamado"
    );
    return;
  }

  if (formData.value.title.length < 10) {
    toastr.error("O campo titulo precisa ter mais de 10 caracteres");
    return;
  }
  if (formData.value.message.length < 10) {
    toastr.error("O campo mensagem precisa ter mais de 10 caracteres");
    return;
  }

  createSupportRequest(formData.value)
    .then((result) => {
      alert("Chamado cadastrado com sucesso");
      formData.value = {
        title: null,
        type: null,
        urgency: null,
        message: null,
        file: null,
      };

      window.location.reload();
    })
    .catch((err) => {
      toastr.error("Erro ao tentar cadastrar chamado!");
    });
};
</script>




<style scoped>
#modalAddNewSupportRequest form button,
button.chamado {
  background-color: #720455;
  color: #fff;
  border-radius: 5px;
  border: none;
  padding: 7px 14px;
}
</style>