import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
   {
    path: '/',
    name: 'dashboard',
    component: () => import('@/pages/dashboard.vue'),
   },
   {
    path: '/login',
    name: 'login',
    component: () => import('@/pages/login.vue'),
   }
  ],
})

export default router
