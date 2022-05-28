import {createRouter, createWebHashHistory} from '@ionic/vue-router'

const routes = [
	// routes go here
	{
		path: '/',
		redirect: '/home'
	},
	{
		path: '/home',
		name: 'Home',
		component: () => import('../views/Home.vue')
	}
]

const router = createRouter({
	history: createWebHashHistory(import.meta.env.BASE_URL),
	routes,
})

export default router
