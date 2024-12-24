<template>
  <ul class="list-group" v-if="dataSearch != null">
    <SupportRequestComponent
      v-for="data in dataSearch.data"
      :key="data.id"
      :supportRequest="data"
    />
  </ul>
  <div class="mt-4">
    <Bootstrap4Pagination
      v-if="dataSearch != null"
      :data="dataSearch"
      @pagination-change-page="loadData"
    >
    </Bootstrap4Pagination>
  </div>
</template>

<script setup>
import { getNewSupportRequests } from "@/services/support";
import { useToastr } from "@/services/toastr";
import { onMounted, ref } from "vue";
import SupportRequestComponent from "@/components/support/SupportRequestComponent";
import { Bootstrap4Pagination } from "laravel-vue-pagination";

const toastr = useToastr();
const dataSearch = ref(null);

onMounted(() => {
  loadData(1);
});

const loadData = (page) => {
  getNewSupportRequests(page)
    .then((result) => {
      const data = result.data.success;
      dataSearch.value = data;
    })
    .catch((err) => {
      toastr.error("Erro ao tentar buscar novos chamados!");
    });
};
</script>

