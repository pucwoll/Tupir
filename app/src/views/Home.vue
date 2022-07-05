<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-buttons class="justify-center">
          <ion-button class="font-semibold">
            <span>Following</span>
          </ion-button>
          <ion-button class="font-semibold">
            <span>For you</span>
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content fullscreen>
      <div
        v-for="creator in catchphrasesStore.creators"
        :key="creator.id"
      >
        <ion-card
          v-for="catchphrase in catchphrasesStore.getCatchphrasesByCreatorId(creator.id)"
          :key="catchphrase.id"
          button
          @click="playAudio(catchphrase)"
        >
          <ion-card-content>
            <p>{{ creator.name }} {{ creator.surname }}</p>
            <p>{{ catchphrase.title }}</p>
          </ion-card-content>
        </ion-card>
      </div>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import { useCatchphrasesStore } from '@/store/catchphrases'
import { App } from '@capacitor/app'
import { onBeforeUnmount, onMounted, ref } from 'vue'
import type { Catchphrase } from '@/interfaces/catchphrases'

const catchphrasesStore = useCatchphrasesStore()

const currentAudio = ref<HTMLAudioElement>(new Audio())

onMounted(() => {
  catchphrasesStore.fetchCatchphrases()

  App.addListener('appStateChange', (state) => {
    if(!state.isActive) {
      currentAudio.value.pause()
    }
  })
})

onBeforeUnmount(() => {
  App.removeAllListeners()
})

async function playAudio(catchphrase: Catchphrase) {
  console.log(catchphrase)
  if(!currentAudio.value.paused) {
    currentAudio.value.pause()
  }
  currentAudio.value = new Audio(catchphrase.audio)
  await currentAudio.value.play()
}

</script>

<style scoped>
ion-toolbar {
	--background: transparent;
	--border-width: 0 !important;
}

ion-content {
	--background: linear-gradient(163.53deg, rgba(189, 224, 254, 0.5) 26.71%, rgba(251, 214, 210, 0) 88.59%), linear-gradient(137.84deg, rgba(255, 175, 204, 0.3) 0%, rgba(241, 144, 183, 0) 81.9%), linear-gradient(338.12deg, rgba(255, 200, 221, 0.8) 14.29%, rgba(206, 73, 191, 0) 90.05%), linear-gradient(106.23deg, rgba(205, 180, 219, 0.7) -1.99%, rgba(166, 62, 197, 0) -1.99%);
}

ion-button > span {
	color: white;
	text-shadow: 1px 1px rgba(0, 0, 0, 0.2);
}
</style>
