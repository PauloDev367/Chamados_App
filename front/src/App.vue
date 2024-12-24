<template>
  <nav
    class="navbar navbar-expand-lg navbar-light bg-light"
    v-if="user != null"
  >
    <a
      class="navbar-brand"
      :href="user.role == 'SUPPORT' ? '/support' : '/client'"
      >Chamados App</a
    >
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a
            class="nav-link"
            :href="user.role == 'SUPPORT' ? '/support' : '/client'"
          >
            Home
          </a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link btn btn-sm btn-outline-danger"
            href="/"
            @click="logout"
          >
            Sair</a
          >
        </li>
      </ul>
    </div>
  </nav>
  <router-view />
</template>


<script setup>
import { ref } from "vue";
import { getUserFromLocalStorage } from "./services/user";

const path = ref(window.location.pathname);

const user = getUserFromLocalStorage();

const logout = () => {
  window.localStorage.clear();
  window.location.href = "/";
};
</script>