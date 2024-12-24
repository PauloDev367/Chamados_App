<template>
  <ul class="list-group" v-if="dataSearch != null">
    <SupportRequestInProgressComponent
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
import { getInProgressSupportRequests } from "@/services/support";
import { useToastr } from "@/services/toastr";
import { onMounted, ref } from "vue";
import SupportRequestInProgressComponent from "@/components/support/SupportRequestInProgressComponent";
import { Bootstrap4Pagination } from "laravel-vue-pagination";

const toastr = useToastr();
const dataSearch = ref(null);

onMounted(() => {
  loadData(1);
});

const loadData = (page) => {
  getInProgressSupportRequests(page)
    .then((result) => {
      const data = result.data.success;
      dataSearch.value = data;
    })
    .catch((err) => {
      toastr.error("Erro ao tentar buscar novos chamados!");
    });
};
</script>



<style scoped>
.list-group-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: all 0.3s;
  padding: 0;
}
.list-group-item .area-base {
  display: flex;
  width: 100%;
  justify-content: space-between;
  align-items: center;
  color: #000;
  padding: 0.75rem 1.25rem;
  text-decoration: none;
}
.list-group-item .area-base:hover {
  background-color: #f7f7f7;
  cursor: pointer;
}
.list-group-item:hover {
  background-color: #f7f7f7;
  cursor: pointer;
}
.list-group-item .title-area h3 {
  font-size: 1.2rem;
}
.list-group-item .title-area h4 {
  font-size: 0.9rem;
  font-weight: 400;
  margin-bottom: 0;
}
.list-group-item .title-area .badge {
  padding: 5px;
}
.list-group-item .badges-area .badge {
  margin: 5px;
  margin-bottom: 0;
}
</style>