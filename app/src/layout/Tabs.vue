<template>
  <ion-page>
    <ion-tabs>
      <ion-router-outlet />
      <ion-tab-bar slot="bottom">
        <ion-tab-button
          tab="tab1"
          href="/tabs/home"
        >
          <ion-icon :icon="home" />
          <ion-label>Home</ion-label>
        </ion-tab-button>

        <ion-tab-button
          tab="tab2"
          href="/tabs/browse"
        >
          <ion-icon :icon="compass" />
          <ion-label>Browse</ion-label>
        </ion-tab-button>

        <ion-tab-button
          tab="tab3"
          href="/tabs/profile"
        >
          <ion-icon :icon="personCircle" />
          <ion-label>Profile</ion-label>
        </ion-tab-button>
      </ion-tab-bar>
    </ion-tabs>
  </ion-page>
</template>

<script setup lang="ts">
import { home, compass, personCircle } from 'ionicons/icons'
</script>

<style scoped>
ion-tab-button {
	box-sizing: border-box;
	margin-left: 25px;
	margin-right: 25px;
	border-bottom: 3px solid transparent;
	border-top: 3px solid transparent;
}
ion-tab-button.tab-selected {
	border-top: 3px var(--color-selected) solid;
}
</style>
