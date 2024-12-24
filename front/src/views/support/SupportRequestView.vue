<template>
  <div class="base">
    <main v-if="supportRequest != null">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    :value="supportRequest.title"
                    readonly
                  />
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    :value="
                      SupportRequestTypeFormatter.getBadgeTranslate(
                        supportRequest.type
                      )
                    "
                    readonly
                  />
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    :value="
                      SupportRequestUrgencyFormatter.getBadgeTranslate(
                        supportRequest.urgency
                      )
                    "
                    readonly
                  />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <textarea
                    rows="5"
                    readonly
                    class="form-control"
                    v-model="supportRequest.message"
                  ></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12" v-if="supportRequest.support_id != null">
            <div v-if="supportRequestMessages != null">
              <div class="area-actions text-right pb-3">
                <template
                  v-if="supportRequestWasEndend(supportRequest.status) != true"
                >
                  <button
                    class="btn btn-sm btn-danger"
                    @click="endSupportRequest"
                  >
                    <i class="fa-solid fa-ban"></i>
                    Finalizar chamado
                  </button>
                </template>

                <template v-else>
                  <span class="btn btn-sm btn-block btn-success">
                    <i class="fa-regular fa-circle-check"></i> Chamado
                    finalizado
                  </span>
                </template>
              </div>

              <div class="area-messages">
                <template v-for="data in supportRequestMessages" :key="data.id">
                  <div
                    :class="
                      data.type == MessagesTypes.CLIENT
                        ? 'client-message'
                        : 'support-message'
                    "
                  >
                    <span>{{ data.message }}</span>
                  </div>
                </template>
              </div>
              
              <template
                v-if="supportRequestWasEndend(supportRequest.status) != true"
              >
                <div class="message-submit-area">
                  <input type="text" />
                  <button>
                    <i class="fa-solid fa-paper-plane"></i>
                  </button>
                </div>
              </template>
            </div>
          </div>

          <div class="col-12 mb-3" v-else>
            <button
              class="btn btn-block btn-sm btn-success"
              @click="clientGetSupportRequest"
            >
              <i class="fa-regular fa-circle-check"></i> Atender chamado
            </button>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>


<script setup>
import { SupportRequestTypeFormatter } from "@/constants/SupportRequestTypeFormatter";
import { SupportRequestUrgencyFormatter } from "@/constants/SupportRequestUrgencyFormatter";
import { MessagesTypes } from "@/constants/MessagesTypes";
import {
  getOneSupportRequest,
  getSupportRequestMessages,
  supportFinishSuppportRequest,
  supportGetSuppportRequest,
} from "@/services/support";
import { useToastr } from "@/services/toastr";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { SupportRequestStatus } from "@/constants/SupportRequestStatus";

const route = useRoute();
const supportRequestId = route.params.id;
const toastr = useToastr();

const supportRequest = ref(null);
const supportRequestMessages = ref(null);

onMounted(() => {
  getOneSupportRequest(supportRequestId)
    .then((result) => {
      supportRequest.value = result.data.success;
      if (supportRequest.value.support_id != null) {
        getAllSupportRequestMessages();
      }
    })
    .catch((err) => {
      toastr.error("Erro ao tentar buscar dados");
    });
});

const supportRequestWasEndend = (status) => {
  const wasEnded =
    status == SupportRequestStatus.FINISHED_BY_CLIENT ||
    status == SupportRequestStatus.FINISHED_BY_SUPPORT;

  return wasEnded;
};

const getAllSupportRequestMessages = () => {
  getSupportRequestMessages(supportRequest.value.id)
    .then((result) => {
      supportRequestMessages.value = result.data.success;
    })
    .catch((err) => {
      toastr.error("Erro ao tentar buscar dados");
    });
};

const clientGetSupportRequest = () => {
  supportGetSuppportRequest(supportRequestId)
    .then((result) => {
      alert("Chamado pego com sucesso");
      window.location.reload();
    })
    .catch((err) => {
      toastr.error("Erro ao tentar pegar chamado");
    });
};

const endSupportRequest = () => {
  supportFinishSuppportRequest(supportRequestId)
    .then((result) => {
      alert("Chamado finalizado com sucesso");
      window.location.reload();
    })
    .catch((err) => {
      toastr.error("Erro ao tentar finalizar chamado");
    });
};
</script>


<style scoped>
.base {
  padding-bottom: 40px;
  height: 100%;
  min-height: 100vh;
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
  background-color: rgba(138, 43, 226, 0.3);
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