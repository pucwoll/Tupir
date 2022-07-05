import { fileURLToPath, URL } from 'url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

import Components from 'unplugin-vue-components/vite'
import Icons from 'unplugin-icons/vite'
import IconsResolver from 'unplugin-icons/resolver'


// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    Icons({ compiler: 'vue3' }),
    Components({
      resolvers: [
        IconsResolver(),
        (componentName) => {
          if(componentName.startsWith('Ion')) {
            return { name: componentName, from: '@ionic/vue' }
          }
        }
      ]
    })
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  }
})
