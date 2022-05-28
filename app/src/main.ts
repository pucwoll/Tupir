import { createApp } from 'vue'
import App from './App.vue'
import './theme/index.css'
import { IonicVue } from '@ionic/vue'
import router from './router'
import {createPinia} from 'pinia'

const app = createApp(App)
	.use(IonicVue)
	.use(router)
	.use(createPinia())

router.isReady().then(() => {
	app.mount('#app')
})
