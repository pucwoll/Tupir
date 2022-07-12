<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>
          <ion-buttons
            class="justify-center"
          >
            <ion-button
              class="font-semibold header-button"
              color="light"
              @click="currentSegment = 'following'"
            >
              <span :class="currentSegment === 'following' ? 'selected' : ''">Following</span>
            </ion-button>
            <ion-button
              class="font-semibold header-button"
              color="light"
              @click="currentSegment = 'for you'"
            >
              <span :class="currentSegment === 'for you' ? 'selected' : ''">For You</span>
            </ion-button>
          </ion-buttons>
        </ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content
      fullscreen
    >
      <recycle-scroller
        :items="catchphrasesStore.catchphrases"
        :item-size="248"
      >
        <template #default="{ item }">
          <catchphrase-card
            :user="item.user"
            :catchphrase="item"
          />
        </template>
      </recycle-scroller>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import { useCatchphrasesStore } from '@/store/catchphrases'
import { App } from '@capacitor/app'
import { onBeforeUnmount, onMounted, ref } from 'vue'
import CatchphraseCard from '@/components/CatchphraseCard.vue'
import { useAudioStore } from '@/store/audio'
import 'vue-virtual-scroller/dist/vue-virtual-scroller.css'
import { RecycleScroller } from 'vue-virtual-scroller'

const catchphrasesStore = useCatchphrasesStore()
const audioStore = useAudioStore()

const currentSegment = ref<'following'| 'for you'>('for you')

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
	text-shadow: 0px 1px 2px rgba(var(--ion-color-dark-rgb), 0.2);
}

.header-button {
  overflow: hidden;
}

.header-button > span.selected {
	padding-bottom: 4px;
	padding-top: 4px;
	border-bottom: 2px solid var(--ion-color-light);
	border-top: 2px solid transparent;
	text-shadow: 0px 2px 5px rgba(var(--ion-color-dark-rgb), 0.2);
}

.header-button > span:not(.selected) {
	@apply opacity-80
}
</style>
