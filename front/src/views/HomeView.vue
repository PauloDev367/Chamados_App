<template>
  <div class="base">
    <form @submit.prevent="enter">
      <h2>Login</h2>
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          v-model="formLogin.email"
          placeholder="E-mail"
        />
      </div>
      <div class="form-group">
        <input
          type="password"
          class="form-control"
          v-model="formLogin.password"
          placeholder="Senha"
        />
      </div>

      <button :disabled="buttonSubmitDisabled">Entrar</button>
    </form>
  </div>
</template>

<script setup>
import { useToastr } from "@/services/toastr";
import { ref } from "vue";
import { login, me } from "@/services/user";
import { CLIENT, SUPPORT } from "@/constants";

const toastr = useToastr();
const buttonSubmitDisabled = ref(false);

const formLogin = ref({
  email: null,
  password: null,
});

const enter = () => {
  if (
    formLogin.value.email == null ||
    formLogin.value.password == null ||
    formLogin.value.email == "" ||
    formLogin.value.password == ""
  ) {
    toastr.error("Preencha o e-mail e a senha para continuar");
    return;
  }

  buttonSubmitDisabled.value = true;
  login(formLogin.value.email, formLogin.value.password)
    .then((result) => {
      if (result.status == 200) {
        const token = result.data.access_token;
        window.localStorage.setItem("token", token);
        me()
          .then((result) => {
            const user = result.data;
            window.localStorage.setItem("user", JSON.stringify(user));
            if (user.role == CLIENT) {
              window.location.href = "/client";
            }
            if (user.role == SUPPORT) {
              window.location.href = "/support";
            }
          })
          .catch((err) => {
            buttonSubmitDisabled.value = false;
            toastr.error("Erro ao tentar fazer login! Tente novamente.");
          });
      }
    })
    .catch((err) => {
      buttonSubmitDisabled.value = false;
      toastr.error("E-mail ou senha inválidos.");
    });
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