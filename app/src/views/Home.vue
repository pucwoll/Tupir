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
.header-button {
  span {
    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    color: #ffffff;
    &.selected {
      padding-bottom: 4px;
      padding-top: 4px;
      border-bottom: 2px solid #ffffff;
      border-top: 2px solid transparent;
    }
    &:not(.selected) {
      opacity: 0.5;
    }
  }
}
</style>
