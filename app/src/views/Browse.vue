<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title
          color="light"
        >
          Browse
        </ion-title>
      </ion-toolbar>
      <ion-toolbar>
        <ion-searchbar />
      </ion-toolbar>
    </ion-header>
    <ion-content fullscreen>
      <h1 class="text-xl font-bold ml-4 white-text-with-shadow">
        Popular Users
      </h1>
      <h1 class="text-xl font-bold ml-4 white-text-with-shadow">
        Popular Catchphrases
      </h1>
      <div>
        <CatchphraseCard
          v-for="catchphrase in catchphrasesStore.catchphrases"
          :catchphrase="catchphrase"
          :user="catchphrase.user"
        />
      </div>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import { useCatchphrasesStore } from '@/store/catchphrases'

const catchphrasesStore = useCatchphrasesStore()

</script>

<style scoped>
</style>
