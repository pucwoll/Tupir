<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>
          Profile
        </ion-title>
        <ion-buttons slot="end">
          <ion-button>
            <ion-icon
              slot="icon-only"
              class="text-white"
              :icon="cog"
            />
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content fullscreen>
      <h1 class="text-3xl white-text-with-shadow font-bold mx-4 mb-32">
        Jakub Jelínek
      </h1>
      <div class="wrapper">
        <ion-avatar class="avatar">
          <img src="@/assets/avatar.jpeg">
        </ion-avatar>
        <h1 class="text-center font-bold -mt-16">
          @jeliinekj
        </h1>
        <h2 class="text-center">
          <ion-label
            color="medium"
          >
            CTO
          </ion-label>
        </h2>
        <div class="flex justify-evenly text-center mt-4 mb-8">
          <div class="w-32">
            <p class="font-bold">
              146
            </p>
            <p class="font-medium">
              <ion-label color="medium">
                Followers
              </ion-label>
            </p>
          </div>
          <div class="w-32">
            <p class="font-bold">
              9
            </p>
            <p class="font-medium">
              <ion-label color="medium">
                Following
              </ion-label>
            </p>
          </div>
          <div class="w-32">
            <p class="font-bold">
              1488
            </p>
            <p class="font-medium">
              <ion-label color="medium">
                Likes
              </ion-label>
            </p>
          </div>
        </div>
        <div class="flex justify-center mb-8">
          <ion-button
            fill="outline"
          >
            Edit Profile
          </ion-button>
        </div>
        <div>
          <div>
            <ion-tab-bar>
              <ion-tab-button
                @click="test"
              >
                <ion-icon
                  :icon="heart"
                />
                <ion-label>Liked</ion-label>
              </ion-tab-button>
              <ion-tab-button
                @click="test"
              >
                <ion-icon :icon="bookmark" />
                <ion-label>Saved</ion-label>
              </ion-tab-button>
              <ion-tab-button
                @click="test"
              >
                <ion-icon :icon="chatbubbleEllipses" />
                <ion-label>Commented</ion-label>
              </ion-tab-button>
              <ion-tab-button
                @click="test"
              >
                <ion-icon :icon="person" />
                <ion-label>Created</ion-label>
              </ion-tab-button>
            </ion-tab-bar>
          </div>
        </div>
      </div>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import { cog , heart, bookmark, chatbubbleEllipses, person } from 'ionicons/icons'

function test() {
  console.log('test')
}
</script>

<style scoped>
.avatar {
  margin-left: auto;
  margin-right: auto;
  position: relative;
  top: -75px;
  height: 150px;
  width: 150px;
}

.wrapper {
  border-top-left-radius: 2rem;
  border-top-right-radius: 2rem;
  background: var(--ion-card-background);
}

ion-tab-bar {
  --background: transparent;
}
</style>
