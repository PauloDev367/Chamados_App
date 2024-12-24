<template>
  <li class="list-group-item" v-if="props.supportRequest != null">
    <a
      :href="`/support/support-request/${props.supportRequest.id}`"
      class="area-base"
    >
      <div class="title-area">
        <h3 class="title">{{ props.supportRequest.title }}</h3>
        <div>
          <h4>{{ formatDate(props.supportRequest.created_at) }}</h4>
          <span class="badge badge-success">
              <i class="fa-regular fa-circle-check"></i> Chamado finalizado
            </span>
        </div>
      </div>

      <div class="badges-area">
        <span
          class="badge"
          :class="
            SupportRequestUrgencyFormatter.getBadgeColor(
              props.supportRequest.urgency
            )
          "
        >
          {{
            SupportRequestUrgencyFormatter.getBadgeTranslate(
              props.supportRequest.urgency
            )
          }}
        </span>

        <span
          class="badge"
          :class="
            SupportRequestTypeFormatter.getBadgeColor(props.supportRequest.type)
          "
        >
          {{
            SupportRequestTypeFormatter.getBadgeTranslate(
              props.supportRequest.type
            )
          }}
        </span>

        <span
          class="badge"
          :class="
            SupportRequestStatusFormatter.getBadgeColor(
              props.supportRequest.status
            )
          "
        >
          {{
            SupportRequestStatusFormatter.getBadgeTranslate(
              props.supportRequest.status
            )
          }}
        </span>
      </div>
    </a>
  </li>
</template>

<script setup>
import { SupportRequestStatusFormatter } from "@/constants/SupportRequestStatusFormatter.js";
import { SupportRequestUrgencyFormatter } from "@/constants/SupportRequestUrgencyFormatter.js";
import { SupportRequestTypeFormatter } from "@/constants/SupportRequestTypeFormatter.js";
const props = defineProps({
  supportRequest: {
    required: true,
  },
});

const formatDate = (isoDate) => {
  const date = new Date(isoDate);

  const pad = (number) => String(number).padStart(2, "0");
  const day = pad(date.getDate());
  const month = pad(date.getMonth() + 1);
  const year = date.getFullYear();

  const hours = pad(date.getHours());
  const minutes = pad(date.getMinutes());
  const seconds = pad(date.getSeconds());

  return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
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