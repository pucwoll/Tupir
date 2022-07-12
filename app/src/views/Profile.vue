<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title
          color="light"
        >
          Profile
        </ion-title>
        <ion-buttons slot="end">
          <ion-button color="light">
            <ion-icon
              slot="icon-only"
              :icon="cog"
            />
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content fullscreen />
  </ion-page>
</template>

<script setup lang="ts">
import { cog } from 'ionicons/icons'
</script>

<style scoped>
</style>
