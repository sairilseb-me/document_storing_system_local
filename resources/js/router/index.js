import { createRouter, createWebHistory } from 'vue-router'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'

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
   },
   {
    path: '/users',
    name: 'users',
    component: () => import('@/views/pages/users/users.vue'),
    meta: {
      layout: 'default'
    }
   },
   {
    path: '/offices',
    name: 'offices',
    component: () => import('@/views/pages/offices/offices.vue'),
    meta: {
      layout: 'default'
      }
    },
    {
      path: '/files',
      name: 'files',
      component: () => import('@/views/pages/files/files.vue'),
      meta: {
        layout: 'default'
      }
    }
  ],
  
})

router.beforeEach((to, from, next) => {
  const snackbarStore = useGlobalSnackbarStore()
  if (to.name !== 'login' && !localStorage.getItem('token')) {
    snackbarStore.setValues({
      show: true,
      message: 'Unauthorized login, please login first.',
      color: 'error'
    })
    next({ name: 'login' })
  } else {
     if (to.path == '/login'){
      next({path: '/'})
     } else {
      next()
     }
  }
}) 

export default router
