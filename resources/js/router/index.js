import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
   {
    path: '/',
    name: 'dashboard',
    component: () => import('@/pages/dashboard.vue'),
    meta: {
      layout: 'default'
    }
   },
   {
    path: '/login',
    name: 'login',
    component: () => import('@/pages/login.vue'),
    meta: {
      layout: 'blank'
    }
   },
   {
    path: '/roles',
    name: 'roles',
    component: () => import('@/views/pages/users/roles.vue'),
    meta: {
      layout: 'default'
    }
   }
  ],
})

export default router
