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
          class="pointer-events-none"
        >
          <ion-icon :icon="addCircle" />
          <ion-label>Create</ion-label>
        </ion-tab-button>

        <ion-tab-button
          tab="tab4"
          href="/tabs/inbox"
        >
          <ion-icon :icon="fileTray" />
          <ion-label>Inbox</ion-label>
        </ion-tab-button>

        <ion-tab-button
          tab="tab5"
          href="/tabs/profile"
        >
          <ion-icon :icon="personCircle" />
          <ion-label>Profile</ion-label>
        </ion-tab-button>
      </ion-tab-bar>
      <ion-fab
        slot="fixed"
        vertical="bottom"
        horizontal="center"
      >
        <ion-fab-button>
          <ion-icon
            :icon="addCircle"
            color="medium"
          />
        </ion-fab-button>
      </ion-fab>
    </ion-tabs>
  </ion-page>
</template>

<script setup lang="ts">
import { home, compass, personCircle, fileTray, addCircle } from 'ionicons/icons'
</script>

<style scoped>
ion-tab-bar {
	--background: white;
}

ion-tab-button {
	box-sizing: border-box;
	border-bottom: 3px solid transparent;
	border-top: 3px solid var(--ion-color-light);
}
ion-tab-button.tab-selected {
	border-top: 3px var(--color-selected) solid;
}
ion-tab-button.tab-selected ion-label {
	font-weight: bold;
}

ion-fab-button {
	margin-bottom: 8px;
	--box-shadow: none;
	--background: white;
	--background-activated: white;
	--background-focused: white;
	--border-color: var(--ion-color-light);
	--border-width: 3px;
	--border-style: solid;
}

ion-fab-button ion-icon {
	height: 50px;
	width: 50px;
}
</style>
