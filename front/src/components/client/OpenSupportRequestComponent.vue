<template>
  <ul class="list-group" v-if="supportRequestsSearch != null">
    <li class="list-group-item">
      <template v-for="data in supportRequestsSearch.data" :key="data.id">
        <ClientSupportRequestComponent :supportRequest="data" />
      </template>
    </li>
  </ul>
</template>
<script setup>
import { getClientSupportRequests } from "@/services/client";
import { useToastr } from "@/services/toastr";
import { onMounted, ref } from "vue";
import ClientSupportRequestComponent from "@/components/client/ClientSupportRequestComponent.vue";
const supportRequestsSearch = ref(null);
onMounted(() => {
  getAllClientSupportRequest(1);
});

const toastr = useToastr();

const getAllClientSupportRequest = (page) => {
  getClientSupportRequests(page)
    .then((result) => {
      supportRequestsSearch.value = result.data.success;
    })
    .catch((err) => {
      toastr.error("Erro ao tentar buscar seus chamados");
    });
};
</script>

