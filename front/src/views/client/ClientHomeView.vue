<template>
  <div class="base">
    <main>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="head-view">
              <h2>Meus chamados</h2>
              <button class="chamado">
                <i class="fa-regular fa-square-plus"></i> Abrir chamado
              </button>
            </div>
            <hr />
          </div>
          <div class="col-12">
            <div class="head-content">
              <ul>
                <li>
                  <a href="#" class="active">Chamos abertos</a>
                </li>
                <li>
                  <a href="#">Chamos fechados</a>
                </li>
              </ul>
            </div>
            <div class="body-content">
              <OpenSupportRequestComponent />
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import OpenSupportRequestComponent from "./../../components/client/OpenSupportRequestComponent.vue";
</script>

<style scoped>
.base {
  height: 100vh;
  background-color: #35374b;
}
main {
  padding-top: 40px;
}
main .container {
  background-color: #fff;
  padding: 20px;
}

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