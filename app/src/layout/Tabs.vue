<template>
  <ion-page>
    <ion-tabs id="main-tabs">
      <ion-router-outlet />
      <ion-tab-bar
        slot="bottom"
        ref="mainTabBar"
      >
        <ion-tab-button
          v-for="tab in tabs"
          :id="`tab${tab.id}`"
          :key="tab.id"
          :tab="`tab${tab.id}`"
          :href="tab?.href"
          :class="{
            'modal-active tab-selected': modal && !tab.href,
          }"
          @click="closeModal"
        >
          <ion-icon
            :icon="
              // @ts-expect-error wrong types
              icons[tab.icon]
            "
          />
          <ion-label>{{ tab.label }}</ion-label>
        </ion-tab-button>
      </ion-tab-bar>
      <ion-fab
        slot="fixed"
        vertical="bottom"
        horizontal="center"
      >
        <ion-fab-button
          :class="{'modal-active': modal}"
          @click="createModal()"
        >
          <ion-icon
            :icon="icons.addCircle"
            :color="modal ? 'third' :'medium'"
          />
        </ion-fab-button>
      </ion-fab>
    </ion-tabs>
  </ion-page>
</template>

<script setup lang="ts">
import * as icons from 'ionicons/icons'
import { modalController } from '@ionic/vue'
import CreateCatchphrase from '@/views/CreateCatchphrase.vue'
import tabs from './config/tabs.json'
import { ref } from 'vue'

const modal = ref<HTMLIonModalElement|null>(null)
const isModalOpened = ref(false)
const mainTabBar = ref<HTMLIonTabBarElement|null>(null)

async function createModal() {
  if(isModalOpened.value) {
    if (modal.value) {
      closeModal()
    }
    return
  }
  isModalOpened.value = true

  modal.value = await modalController.create({
    component: CreateCatchphrase,
    initialBreakpoint: 0.95,
    breakpoints: [0, 0.95],
  })
  // @ts-expect-error wrong types
  document.querySelector(`#tab-button-${mainTabBar.value?.tabState.activeTab}`)?.classList.remove('tab-selected')

  document.querySelector('#main-tabs')?.appendChild(modal.value)
  modal.value.present()

  modal.value.onDidDismiss().then(() => {
    closeModal()
  })
}

function closeModal() {
  if(modal.value) {
    modal.value.dismiss()
    modal.value = null
    isModalOpened.value = false
    // @ts-expect-error wrong types
    document.querySelector(`#tab-button-${mainTabBar.value?.tabState.activeTab}`)?.classList.add('tab-selected')
  }
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
	--background-activated: var(--ion-background-color);
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

ion-tab-bar {
  z-index: 25000;
}
ion-fab {
  z-index: 25001;
}
</style>
