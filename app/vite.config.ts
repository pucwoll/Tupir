import { fileURLToPath, URL } from 'url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

import Components from 'unplugin-vue-components/vite'
import Icons from 'unplugin-icons/vite'
import IconsResolver from 'unplugin-icons/resolver'
import { FileSystemIconLoader } from 'unplugin-icons/loaders'


// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    Icons({
      compiler: 'vue3',
      customCollections: {
        'tupir': FileSystemIconLoader('./src/assets/icons'),
      }
    }),
    Components({
      resolvers: [
        IconsResolver({
          customCollections: ['tupir']
        }),
        (componentName) => {
          if(componentName.startsWith('Ion')) {
            return {
              name: componentName,
              from: '@ionic/vue',
              sideEffects: [
                '@ionic/vue/css/core.css',
                '@ionic/vue/css/normalize.css',
                '@ionic/vue/css/structure.css',
                '@ionic/vue/css/typography.css',
                '@ionic/vue/css/padding.css',
                '@ionic/vue/css/float-elements.css',
                '@ionic/vue/css/text-alignment.css',
                '@ionic/vue/css/text-transformation.css',
                '@ionic/vue/css/flex-utils.css',
                '@ionic/vue/css/display.css'
              ]
            }
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
