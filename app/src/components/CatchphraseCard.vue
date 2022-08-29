<template>
  <ion-card>
    <ion-card-content class="flex justify-between">
      <div class="flex flex-col grow">
        <div class="mb-4 flex items-center">
          <ion-avatar class="mr-4">
            <img
              :src="user.avatar.path"
              alt="avatar"
              style="height: 100%; width: 100%;"
            >
          </ion-avatar>
          <div class="grow">
            <div class="flex items-center">
              <h1>{{ user.name }}</h1>
            </div>
            <div class="flex">
              <h4>
                {{ user.username }}
              </h4>
            </div>
          </div>
        </div>
        <div class="h-full flex items-center w-full">
          <ion-buttons class="h-full w-full">
            <ion-button
              class="h-full grow"
              color="dark"
              @click="playAudio"
            >
              <i-tupir-logo
                v-if="audioStore.currentAudio?.src !== catchphrase.audio"
                class="icon"
              />
              <i-tupir-pause
                v-else
                class="icon"
              />
              <h2 class="whitespace-pre-wrap mx-4 text-start">
                <q>
                  {{ catchphrase.lyrics }}
                </q>
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
            <ion-button @click="share">
              <ion-icon
                slot="icon-only"
                :icon="arrowRedoOutline"
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
import type { Catchphrase, CatchphraseUser } from '@/interfaces/catchphrases'
import { arrowRedoOutline, chatbubbleEllipsesOutline, heartOutline } from 'ionicons/icons'
import { useAudioStore } from '@/store/audio'
import { actionSheetController } from '@ionic/vue'
import { Share } from '@capacitor/share'

const audioStore = useAudioStore()

const props = defineProps<{
  user: CatchphraseUser
  catchphrase: Catchphrase
}>()

async function playAudio() {
  if(!audioStore.currentAudio?.paused) {
    audioStore.currentAudio?.pause()
    if(audioStore.currentAudio?.src === props.catchphrase.audio) {
      audioStore.currentAudio = undefined
      return
    }
    audioStore.currentAudio = undefined
  }

  audioStore.currentAudio = new Audio(props.catchphrase.audio)
  audioStore.currentAudio.addEventListener('ended', () => {
    audioStore.currentAudio = undefined
  })
  await audioStore.currentAudio.play()
}

async function share() {
  await Share.share({
    title: 'Share',
    text: 'Share',
    url: 'https://ionicframework.com/'
  })
}

async function showActions() {
  const sheet = await actionSheetController.create({
    header: props.catchphrase.title,
    buttons: [
      {
        text: 'Block',
        role: 'destructive',
      },
      {
        text: 'Report',
        role: 'destructive',
      },
      {
        text: 'Follow',
        role: undefined,
      },
      {
        text: 'Save',
        role: undefined,
      },{
        text: 'Cancel',
        role: 'cancel',
      },
    ]
  })

  await sheet.present()
}

</script>

<style scoped>
.icon {
	@apply w-7;
	min-width: 1.75rem;
}

ion-card {
	max-height: 224px;
	height: 224px;
	min-height: 224px;
	margin-top: 12px;
	margin-bottom: 12px;
}
</style>
