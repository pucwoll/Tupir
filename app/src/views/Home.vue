<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-buttons class="justify-center">
          <ion-button class="font-semibold header-button">
            <span>Following</span>
          </ion-button>
          <ion-button class="font-semibold header-button">
            <span class="selected">For You</span>
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content fullscreen>
      <div
        v-for="creator in catchphrasesStore.creators"
        :key="creator.id"
      >
        <catchphrase-card
          v-for="catchphrase in catchphrasesStore.getCatchphrasesByCreatorId(creator.id)"
          :key="catchphrase.id"
          :creator="creator"
          :catchphrase="catchphrase"
        />
      </div>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import { useCatchphrasesStore } from '@/store/catchphrases'
import { App } from '@capacitor/app'
import { onBeforeUnmount, onMounted } from 'vue'
import CatchphraseCard from '@/components/CatchphraseCard.vue'
import { useAudioStore } from '@/store/audio'

const catchphrasesStore = useCatchphrasesStore()
const audioStore = useAudioStore()

onMounted(() => {
  catchphrasesStore.fetchCatchphrases()

  App.addListener('appStateChange', (state) => {
    if(!state.isActive) {
      audioStore.currentAudio?.pause()
    }
  })
})

onBeforeUnmount(() => {
  App.removeAllListeners()
})

</script>

<style scoped>
ion-toolbar {
	--background: transparent;
	--border-width: 0 !important;
}

ion-content {
	--background: linear-gradient(163.53deg, rgba(189, 224, 254, 0.5) 26.71%, rgba(251, 214, 210, 0) 88.59%), linear-gradient(137.84deg, rgba(255, 175, 204, 0.3) 0%, rgba(241, 144, 183, 0) 81.9%), linear-gradient(338.12deg, rgba(255, 200, 221, 0.8) 14.29%, rgba(206, 73, 191, 0) 90.05%), linear-gradient(106.23deg, rgba(205, 180, 219, 0.7) -1.99%, rgba(166, 62, 197, 0) -1.99%);
}

.header-button > span {
	color: white;
	text-shadow: 1px 1px rgba(0, 0, 0, 0.2);
}

.header-button > span.selected {
	padding-bottom: 4px;
	padding-top: 4px;
	border-bottom: 2px solid white;
	border-top: 2px solid transparent;
	box-shadow: 0 1px rgba(0, 0, 0, 0.2);
}

.header-button > span:not(.selected) {
	@apply opacity-80
}
</style>
