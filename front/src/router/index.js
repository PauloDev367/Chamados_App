import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ClientHomeView from '../views/client/ClientHomeView.vue'
import SupportHomeView from '../views/support/SupportHomeView.vue'
import SupportRequestView from '../views/support/SupportRequestView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/client',
    name: 'client',
    component: ClientHomeView
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
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
