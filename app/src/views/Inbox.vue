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
      <p
        v-for="i in 2000"
        :key="i"
      >
        {{ i }}
      </p>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
</script>

<style scoped>

</style>
