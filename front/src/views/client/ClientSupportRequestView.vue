<template>
  <div class="base">
    <main>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    value="Titulo do chamado"
                    readonly
                  />
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    value="Tipo de chamado"
                    readonly
                  />
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    value="Urgência do chamado"
                    readonly
                  />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <textarea rows="5" readonly class="form-control">
Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint saepe consequuntur expedita nihil culpa totam rem facere, porro vel natus architecto eligendi. Assumenda at ipsam ut nemo cum vero numquam.</textarea
                  >
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="area-actions text-right pb-3">
                <button class="btn btn-sm btn-danger">
                    <i class="fa-solid fa-ban"></i> 
                    Finalizar chamado
                </button>
            </div>
            <div class="area-messages">
              <div class="client-message">
                <span>Mensagem do cliente</span>
              </div>
              <div class="support-message">
                <span>Mensagem do support</span>
              </div>
              <div class="client-message">
                <span>Mensagem do cliente</span>
              </div>
              <div class="support-message">
                <span>Mensagem do support</span>
              </div>
              <div class="client-message">
                <span>Mensagem do cliente</span>
              </div>
              <div class="support-message">
                <span>Mensagem do support</span>
              </div>
              <div class="support-message">
                <span>Mensagem do support</span>
              </div>
              <div class="support-message">
                <span>Mensagem do support</span>
              </div>
            </div>
            <div class="message-submit-area">
              <input type="text" />
              <button>
                <i class="fa-solid fa-paper-plane"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>


<script setup>
</script>


<style scoped>
.base {
  padding-bottom: 40px;
  background-color: #35374b;
}
main {
  padding-top: 40px;
}
main .container {
  background-color: #fff;
  padding-top: 20px;
}
.area-messages {
  border: 1px solid rgba(0, 0, 0, 0.2);
  margin-bottom: 20px;
  padding: 20px;
  border-radius: 5px;
  min-height: 500px;
}
.area-messages .client-message span {
  border-radius: 3px;
  padding: 10px;
  margin-bottom: 10px;
  background-color: rgba(173, 255, 47, 0.5);
  display: inline-block;
}
.area-messages .support-message {
    text-align: right;
}
.area-messages .support-message span {
  border-radius: 3px;
  padding: 10px;
  margin-bottom: 10px;
  display: inline-block;
  background-color: rgba(138, 43, 226, .3);
}

.message-submit-area {
  display: flex;
  justify-content: space-between;
  align-content: center;
  margin-bottom: 20px;
}
.message-submit-area input {
  border: 1px solid rgba(0, 0, 0, 0.2);
  color: rgba(0, 0, 0, 0.8);
  width: 100%;
  padding: 5px 10px;
  border-radius: 3px;
  outline: none;
  margin-right: 10px;
}
.message-submit-area button {
  background-color: #720455;
  color: #fff;
  border: none;
  outline: none;
  padding: 10px;
  border-radius: 3px;
}
</style>