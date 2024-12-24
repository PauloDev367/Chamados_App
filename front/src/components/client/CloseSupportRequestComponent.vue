<template>
  <ul class="list-group" v-if="supportRequestsSearch != null">
    <li class="list-group-item">
      <template v-for="data in supportRequestsSearch.data" :key="data.id">
        <ClientFinishedSupportRequestComponent :supportRequest="data" />
      </template>
    </li>
  </ul>
</template>
<script setup>
import { getClientFinishedSupportRequests } from "@/services/client";
import { useToastr } from "@/services/toastr";
import { onMounted, ref } from "vue";
import ClientFinishedSupportRequestComponent from "@/components/client/ClientFinishedSupportRequestComponent.vue";
const supportRequestsSearch = ref(null);
onMounted(() => {
  getAllClientSupportRequest(1);
});

const toastr = useToastr();

const getAllClientSupportRequest = (page) => {
  getClientFinishedSupportRequests(page)
    .then((result) => {
      supportRequestsSearch.value = result.data.success;
    })
    .catch((err) => {
      console.log(err);
      toastr.error("Erro ao tentar buscar seus chamados");
    });
};
</script>

