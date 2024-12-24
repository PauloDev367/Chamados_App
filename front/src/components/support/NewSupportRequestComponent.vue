<template>
  <ul class="list-group" v-if="dataSearch != null">
    <SupportRequestComponent
      v-for="data in dataSearch.data"
      :key="data.id"
      :supportRequest="data"
    />
  </ul>
</template>

<script setup>
import { getNewSupportRequests } from "@/services/support";
import { useToastr } from "@/services/toastr";
import { onMounted, ref } from "vue";
import SupportRequestComponent from "@/components/support/SupportRequestComponent";
const toastr = useToastr();
const dataSearch = ref(null);

onMounted(() => {
  getNewSupportRequests(1)
    .then((result) => {
      const data = result.data.success;
      dataSearch.value = data;
    })
    .catch((err) => {
      toastr.error("Erro ao tentar buscar novos chamados!");
    });
});
</script>

