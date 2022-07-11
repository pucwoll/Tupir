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
          <ion-icon  :icon="home" />
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
        <ion-fab-button :class="{'is-actived-modal': isOpenedModal}">
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

<script>
import { home, compass, personCircle, fileTray, addCircle } from 'ionicons/icons'
import { modalController } from '@ionic/vue'
import CreatingModal from '@/views/CreateCatchphrase.vue'

export default {
  data() {
    return {
      isOpenedModal: false,
      //icons
      home, compass, personCircle, fileTray, addCircle
    }
  },
  methods: {
    logger(e) {
      this.isOpenedModal = true
      console.log(e)
    },
    createModal() {
      return modalController
        .create({
          component: CreatingModal,
        })
        .then(m => m.present())
    }
  },
}

</script>

<style scoped>
ion-tab-bar {
	--background: var(--ion-background-color);
}

ion-tab-button {
	box-sizing: border-box;
	border-bottom: 3px solid transparent;
	border-top: 3px solid var(--ion-color-light);
}
ion-tab-button.tab-selected {
	border-top: 3px var(--color-selected) solid;
}


ion-tab-button:nth-child(1).tab-selected {
  border-top: 3px solid var(--ion-color-first);
}
ion-tab-button:nth-child(2).tab-selected {
  border-top: 3px solid var(--ion-color-second);
}
ion-tab-button:nth-child(3).tab-selected {
  border-top: 3px solid var(--ion-color-third);
}
ion-tab-button:nth-child(4).tab-selected {
  border-top: 3px solid var(--ion-color-fourth);
}
ion-tab-button:nth-child(5).tab-selected {
  border-top: 3px solid var(--ion-color-fifth);
}


ion-tab-button:nth-child(1).tab-selected ion-icon {
  color: var(--ion-color-first);
}
ion-tab-button:nth-child(2).tab-selected ion-icon {
  color: var(--ion-color-second);
}
ion-tab-button:nth-child(3).tab-selected ion-icon {
  color: var(--ion-color-third);
}
ion-tab-button:nth-child(4).tab-selected ion-icon {
  color: var(--ion-color-fourth);
}ion-tab-button:nth-child(5).tab-selected ion-icon {
  color: var(--ion-color-fifth);
}


ion-tab-button:nth-child(1).tab-selected ion-label {
	font-weight: bold;
  color: var(--ion-color-first);
}
ion-tab-button:nth-child(2).tab-selected ion-label {
	font-weight: bold;
  color: var(--ion-color-second);
}
ion-tab-button:nth-child(3).tab-selected ion-label {
	font-weight: bold;
  color: var(--ion-color-third);
}
ion-tab-button:nth-child(4).tab-selected ion-label {
	font-weight: bold;
  color: var(--ion-color-fourth);
}
ion-tab-button:nth-child(5).tab-selected ion-label {
	font-weight: bold;
  color: var(--ion-color-fifth);
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
}
ion-fab-button > ion-icon {
	transform: rotate(45deg);
}

ion-fab-button ion-icon {
	height: 50px;
	width: 50px;
}

.is-actived-modal {
  border-top: 3px solid var(--ion-color-third);
  border-left: 3px solid var(--ion-color-third);
}
</style>
