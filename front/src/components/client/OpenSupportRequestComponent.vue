<template>
  <ul class="list-group" v-if="supportRequestsSearch != null">
    <template v-for="data in supportRequestsSearch.data" :key="data.id">
      <ClientSupportRequestComponent :supportRequest="data" />
    </template>
  </ul>

  <div class="mt-4">
    <Bootstrap4Pagination
      v-if="supportRequestsSearch != null"
      :data="supportRequestsSearch"
      @pagination-change-page="loadData"
    >
    </Bootstrap4Pagination>
  </div>
</template>
<script setup>
import { getClientSupportRequests } from "@/services/client";
import { useToastr } from "@/services/toastr";
import { onMounted, ref } from "vue";
import ClientSupportRequestComponent from "@/components/client/ClientSupportRequestComponent.vue";
import { Bootstrap4Pagination } from "laravel-vue-pagination";

const supportRequestsSearch = ref(null);
onMounted(() => {
  loadData(1);
});

const toastr = useToastr();

const loadData = (page) => {
  getClientSupportRequests(page)
    .then((result) => {
      supportRequestsSearch.value = result.data.success;
    })
    .catch((err) => {
      toastr.error("Erro ao tentar buscar seus chamados");
    });
};
</script>

