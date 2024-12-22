<template>
  <div class="base">
    <form @submit.prevent="enter">
      <h2>Login</h2>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="E-mail" />
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Senha" />
      </div>

      <button>Entrar</button>
    </form>
  </div>
</template>

<script setup>
const enter = () => {
  window.location = "/client";
};
</script>

<style scoped>
.base {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #35374b;
}

.base form {
  padding: 40px;
  padding-top: 20px;
  background-color: #fff;
  width: 400px;
  border-top: 5px solid #720455;
}
.base form h2 {
  text-align: center;
  font-size: 1.8rem;
  margin-bottom: 20px;
}

.base form button {
  background-color: #720455;
  color: #fff;
  border: none;
  width: 100%;
  padding: 10px;
  font-size: 1.3rem;
}
</style>