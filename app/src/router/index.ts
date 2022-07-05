import { createRouter, createWebHistory } from '@ionic/vue-router'
import type { RouteRecordRaw } from 'vue-router'

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    redirect: '/home'
  },
  {
    path: '/',
    component: () => import('@/layout/Tabs.vue'),
    children: [
      {
        name: 'Home',
        path: '/home',
        component: () => import('@/views/Home.vue')
      },
      {
        name: 'Browse',
        path: '/browse',
        // component: () => import('@/views/Browse.vue')
      },
      {
        name: 'My Profile',
        path: '/profile',
        // component: () => import('@/views/MyProfile.vue')
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

export default router
