<template>
  <div class="base">
    <main>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="head-view">
              <h2>Novos chamados</h2>
            </div>
            <hr />
          </div>
          <div class="col-12">
            <div class="head-content">
              <ul>
                <li>
                  <a
                    href="#"
                    @click.prevent="handleHeadContentView(null)"
                    :class="openSupportRequest == null ? 'active' : ''"
                    >Novos chamados</a
                  >
                </li>
                <li>
                  <a
                    href="#"
                    @click.prevent="handleHeadContentView(true)"
                    :class="openSupportRequest == true ? 'active' : ''"
                    >Em andamento</a
                  >
                </li>
                <li>
                  <a
                    href="#"
                    @click.prevent="handleHeadContentView(false)"
                    :class="openSupportRequest == false ? 'active' : ''"
                    >Chamos finalizados</a
                  >
                </li>
              </ul>
            </div>
            <div class="body-content">
              <NewSupportRequestComponent v-if="openSupportRequest == null" />
              <OpenSupportRequestComponent
                v-else-if="openSupportRequest == true"
              />
              <CloseSupportRequestComponent v-else />
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from "vue";
import OpenSupportRequestComponent from "./../../components/support/OpenSupportRequestComponent.vue";
import CloseSupportRequestComponent from "./../../components/support/CloseSupportRequestComponent.vue";
import NewSupportRequestComponent from "./../../components/support/NewSupportRequestComponent.vue";

const openSupportRequest = ref(null);

const handleHeadContentView = (newStatus) => {
  openSupportRequest.value = newStatus;
};
</script>

<style scoped>
.base {
  height: 100%;
  min-height: 100vh;
  background-color: #35374b;
}
main {
  padding-top: 40px;
}
main .container {
  background-color: #fff;
  padding: 20px;
}

#modalAddNewSupportRequest form button,
button.chamado {
  background-color: #720455;
  color: #fff;
  border-radius: 5px;
  border: none;
  padding: 7px 14px;
}

.head-view {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.head-view h2 {
  font-size: 1.6rem;
  margin-bottom: 0;
}

.head-content ul {
  list-style: none;
  padding: 0;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  width: 100%;
  border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}
.head-content ul li a {
  padding: 10px;
  display: inline-block;
  text-decoration: none;
  color: #000;
}
.head-content ul li a:hover,
.head-content ul li a.active {
  border: 2px solid rgba(0, 0, 0, 0.1);
  border-bottom: 0;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}
</style>