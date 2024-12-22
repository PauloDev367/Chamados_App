import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ClientHomeView from '../views/client/ClientHomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  }, {
    path: '/client',
    name: 'client',
    component: ClientHomeView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
