<template>
  <ion-page>
    <ion-tabs>
      <ion-router-outlet />
      <ion-tab-bar slot="bottom">
        <ion-tab-button
          id="tab1"
          tab="tab1"
          href="/tabs/home"
        >
          <ion-icon :icon="home" />
          <ion-label>Home</ion-label>
        </ion-tab-button>

        <ion-tab-button
          id="tab2"
          tab="tab2"
          href="/tabs/browse"
        >
          <ion-icon :icon="compass" />
          <ion-label>Browse</ion-label>
        </ion-tab-button>

        <ion-tab-button
          id="tab3"
          tab="tab3"
          class="pointer-events-none"
          :class="isModalActive ? 'modal-active' : ''"
        >
          <ion-icon />
          <ion-label>Create</ion-label>
        </ion-tab-button>

        <ion-tab-button
          id="tab4"
          tab="tab4"
          href="/tabs/inbox"
        >
          <ion-icon :icon="fileTray" />
          <ion-label>Inbox</ion-label>
        </ion-tab-button>

        <ion-tab-button
          id="tab5"
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
        <ion-fab-button :class="{'modal-active': isModalActive}">
          <ion-icon
            :icon="addCircle"
            color="medium"
            @click="createModal()"
          />
        </ion-fab-button>
      </ion-fab>
    </ion-tabs>
  </ion-page>
</template>

<script setup lang="ts">
import { home, compass, personCircle, fileTray, addCircle } from 'ionicons/icons'
import { modalController } from '@ionic/vue'
import CreateCatchphrase from '@/views/CreateCatchphrase.vue'
import { ref } from 'vue'

const isModalActive = ref(false)

async function createModal() {
  const modal = await modalController.create({
    component: CreateCatchphrase,
    initialBreakpoint: 0.95,
    breakpoints: [0, 0.25, 0.95]
  })
  await modal.present()
  isModalActive.value = true
  await modal.onDidDismiss()
  isModalActive.value = false
}

</script>

<style scoped>
ion-tab-bar {
	--background: var(--ion-background-color);
	ion-tab-button {
		box-sizing: border-box;
		border-bottom: 3px solid transparent;
		border-top: 3px solid var(--ion-color-light);
		&.tab-selected {
			&:nth-child(1) {
				border-top: 3px solid var(--ion-color-first);
				ion-icon {
					color: var(--ion-color-first);
				}
				ion-label {
					font-weight: bold;
					color: var(--ion-color-first);
				}
			}
			&:nth-child(2) {
				border-top: 3px solid var(--ion-color-second);
				ion-icon {
					color: var(--ion-color-second);
				}
				ion-label {
					font-weight: bold;
					color: var(--ion-color-second);
				}
			}
			&:nth-child(3) {
				border-top: 3px solid var(--ion-color-third);
				ion-icon {
					color: var(--ion-color-third);
				}
				ion-label {
					font-weight: bold;
					color: var(--ion-color-third);
				}
			}
			&:nth-child(4) {
				border-top: 3px solid var(--ion-color-fourth);
				ion-icon {
					color: var(--ion-color-fourth);
				}
				ion-label {
					font-weight: bold;
					color: var(--ion-color-fourth);
				}
			}
			&:nth-child(5) {
				border-top: 3px solid var(--ion-color-fifth);
				ion-icon {
					color: var(--ion-color-fifth);
				}
				ion-label {
					font-weight: bold;
					color: var(--ion-color-fifth);
				}
			}
		}
	}
}


.modal-active {
	border-top: 3px solid var(--ion-color-third);
}

ion-fab-button {
	margin-bottom: 9px;
	--box-shadow: none;
	--background: var(--ion-background-color);
	--background-activated: var(--ion-kokot-color);
	--background-focused: var(--ion-background-color);
	--background-hover: var(--ion-background-color);
	border-radius: 50%;
	border: 3px solid transparent;
	border-top: 3px solid var(--ion-color-light);
	border-left: 3px solid var(--ion-color-light);
	transform: rotate(45deg);
	ion-icon {
		height: 50px;
		width: 50px;
		transform: rotate(45deg);
	}
	&.modal-active {
		border-left: 3px solid var(--ion-color-third);
	}
}
</style>
