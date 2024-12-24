import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ClientHomeView from '../views/client/ClientHomeView.vue'
import ClientSupportRequestView from '../views/client/ClientSupportRequestView.vue'
import SupportHomeView from '../views/support/SupportHomeView.vue'
import SupportRequestView from '../views/support/SupportRequestView.vue'
import { useToastr } from '@/services/toastr'
import isAuthenticated from '@/auth'

const toastr = useToastr();

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    children: [
      {
        path: '/client',
        name: 'client',
        component: ClientHomeView
      },
      {
        path: '/client/support-request/:id',
        name: 'client-supportrequest-page',
        component: ClientSupportRequestView
      },
      {
        path: '/support',
        name: 'support',
        component: SupportHomeView
      },
      {
        path: '/support/support-request/:id',
        name: 'support-page',
        component: SupportRequestView
      },
    ],
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem("token");
      if (token == null) {
        next("/");
        toastr.error("É preciso fazer login para acessar essa página");
        return;
      }

      isAuthenticated()
        .then((response) => {
          if (response) {
            next();
          } else {
            toastr.error("É preciso fazer login para acessar essa página");
            window.location.href = "/";
          }
        })
        .catch(() => {
          toastr.error("É preciso fazer login para acessar essa página");
          window.location.href = "/";
        });
    },
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
