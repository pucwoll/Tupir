<template>
  <ion-content class="ion-padding">
      <p class="title">New catchphrase</p>
      <p>"Žiaden človek nedokáže dať toľko lásky človeku, ako dokáže dať len človek človeku. Ale žiaden iný človek</p>
      <img src="../assets/soundwave.svg" alt="">

      <div class="flex justify-between interface">
        <ion-icon :icon="cloudDownload" />
        <ion-icon :icon="mic" />
        <ion-icon :icon="cloudUpload" />
      </div>
  </ion-content>
</template>
<script setup lang="ts">
import { mic, cloudDownload, cloudUpload } from 'ionicons/icons'

console.log('modal shown')
</script>
<style scoped>
.title {
  margin: 10px 0;
  text-align: center;
  font-size: 30px;
  font-weight: 600;
}
.interface {
  margin: 0 auto;
  width: calc(100vw - 64px);
  align-items: center;

  ion-icon {
    border-radius: 50%;
    padding: 8px;

    &:nth-child(odd) {
      background: var(--ion-color-fifth);
      font-size: 42px;
    }
    &:nth-child(even) {
      background: var(--ion-color-first);
      font-size: 56px;
    }
  }
  /* .main {
    font-size: 46px !important;
  } */
}
</style>
