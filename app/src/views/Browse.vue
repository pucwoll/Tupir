<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title
          color="light"
          class="title"
        >
          Browse
        </ion-title>
      </ion-toolbar>
      <ion-toolbar>
        <ion-searchbar />
      </ion-toolbar>
    </ion-header>
    <ion-content fullscreen>
      <p v-for="i in 2000">
        {{ i }}
      </p>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
</script>

<style scoped>
ion-toolbar {
	--background: transparent;
	--border-width: 0 !important;
}

ion-content {
	--background: linear-gradient(163.53deg, rgba(189, 224, 254, 0.5) 26.71%, rgba(251, 214, 210, 0) 88.59%), linear-gradient(137.84deg, rgba(255, 175, 204, 0.3) 0%, rgba(241, 144, 183, 0) 81.9%), linear-gradient(338.12deg, rgba(255, 200, 221, 0.8) 14.29%, rgba(206, 73, 191, 0) 90.05%), linear-gradient(106.23deg, rgba(205, 180, 219, 0.7) -1.99%, rgba(166, 62, 197, 0) -1.99%);
}

.title {
	text-shadow: 1px 1px rgba(0, 0, 0, 0.2);
}

ion-searchbar {
	--background: rgba(255, 255, 255, 0.4);
}
</style>
