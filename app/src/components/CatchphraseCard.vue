<template>
  <ion-card>
    <ion-card-content class="flex justify-between">
      <div class="flex flex-col">
        <div class="mb-4 flex items-center">
          <ion-avatar class="mr-4">
            <img
              :src="creator.avatar.path"
              alt="avatar"
            >
          </ion-avatar>
          <div>
            <div class="flex items-center">
              <h1>{{ creator.name }} {{ creator.surname }}</h1>
              <ion-buttons>
                <ion-button @click="showActions">
                  <ion-icon
                    slot="icon-only"
                    :icon="ellipsisVertical"
                    class="options-icon"
                    color="medium"
                  />
                </ion-button>
              </ion-buttons>
            </div>
            <h4>{{ creator.username }}</h4>
          </div>
        </div>
        <div class="h-full flex items-center w-full">
          <ion-buttons class="h-full w-full">
            <ion-button
              class="h-full grow"
              color="dark"
              @click="playAudio(catchphrase)"
            >
              <ion-icon
                :icon="volumeHigh"
                class="icon"
                color="dark"
              />
              <h2 class="whitespace-pre-wrap mx-4">
                {{ catchphrase.title }}
              </h2>
              <div class="ml-auto h-full" />
            </ion-button>
          </ion-buttons>
        </div>
      </div>
      <div>
        <ion-buttons class="flex flex-col items-center">
          <div class="flex flex-col items-center mb-2">
            <ion-button>
              <ion-icon
                slot="icon-only"
                :icon="heartOutline"
                class="icon"
                color="dark"
              />
            </ion-button>
            <p>
              12
            </p>
          </div>
          <div class="flex flex-col items-center mb-2">
            <ion-button class="flex flex-col">
              <ion-icon
                slot="icon-only"
                :icon="chatbubbleEllipsesOutline"
                class="icon"
                color="dark"
              />
            </ion-button>
            <p>
              12
            </p>
          </div>
          <div class="flex flex-col items-center">
            <ion-button>
              <ion-icon
                slot="icon-only"
                :icon="bookmarkOutline"
                class="icon"
                color="dark"
              />
            </ion-button>
            <p>
              12
            </p>
          </div>
        </ion-buttons>
      </div>
    </ion-card-content>
  </ion-card>
</template>

<script setup lang="ts">
import type { Catchphrase, CatchphraseCreator } from '@/interfaces/catchphrases'
import { volumeHigh, heartOutline, chatbubbleEllipsesOutline, bookmarkOutline, ellipsisVertical } from 'ionicons/icons'
import { useAudioStore } from '@/store/audio'
import { ActionSheet } from '@capacitor/action-sheet'

const audioStore = useAudioStore()

defineProps<{
  creator: CatchphraseCreator
  catchphrase: Catchphrase
}>()

async function playAudio(catchphrase: Catchphrase) {
  console.log(catchphrase)
  if(!audioStore.currentAudio?.paused) {
    audioStore.currentAudio?.pause()
    audioStore.currentAudio = undefined
  }
  audioStore.currentAudio = new Audio(catchphrase.audio)
  await audioStore.currentAudio.play()
}

async function showActions() {
  await ActionSheet.showActions({
    title: 'test',
    options: [
      {
        title: 'Upload',
      },
      {
        title: 'Share',
      },
    ]
  })
}

</script>

<style scoped>
.icon {
	@apply w-7;
	min-width: 1.75rem;
}

.options-icon {
	@apply w-4 h-4;
	color: var(--ion-card-color, var(--ion-item-color, var(--ion-color-step-600, #666666)));
}
</style>
