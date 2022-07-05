<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Tupir</ion-title>
      </ion-toolbar>
      <ion-toolbar>
        <ion-searchbar />
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <ion-list inset>
        <ion-list-header>Legendy</ion-list-header>
        <ion-accordion-group>
          <ion-accordion
            v-for="creator in creators"
            :key="creator.id"
          >
            <ion-item slot="header">
              <ion-label>{{ creator.name }} {{ creator.surname }}</ion-label>
            </ion-item>

            <ion-list slot="content">
              <ion-item
                v-for="catchphrase in getCatchphrasesByCreatorId(creator.id)"
                :key="catchphrase.id"
                button
                @click="playAudio(catchphrase)"
              >
                <ion-label>{{ catchphrase.title }}</ion-label>
              </ion-item>
            </ion-list>
          </ion-accordion>
        </ion-accordion-group>
      </ion-list>
    </ion-content>
  </ion-page>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { useCatchphrasesStore } from '@/store/catchphrases'
import { mapActions, mapState } from 'pinia'
import type { Catchphrase } from '@/interfaces/catchphrases'
import { App } from '@capacitor/app'

export default defineComponent({
  data() {
    return {
      currentAudio: new Audio()
    }
  },
  computed: {
    ...mapState(useCatchphrasesStore, ['getCatchphrasesByCreatorId', 'creators'])
  },
  async mounted() {
    this.fetchCatchphrases()
    App.addListener('appStateChange', (state) => {
      if(!state.isActive) {
        this.currentAudio.pause()
      }
    })
  },
  beforeUnmount() {
    App.removeAllListeners()
  },
  methods: {
    ...mapActions(useCatchphrasesStore, ['fetchCatchphrases']),
    async playAudio(catchphrase: Catchphrase) {
      console.log(catchphrase)
      if(!this.currentAudio.paused) {
        this.currentAudio.pause()
      }
      this.currentAudio = new Audio(catchphrase.audio)
      await this.currentAudio.play()
    }
  }
})
</script>

<style scoped>
ion-content {
	--background: #f2f2f7;
}

ion-list-header {
	padding-bottom: 12px;
}
</style>
