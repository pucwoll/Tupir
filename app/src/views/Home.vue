<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Tupir</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <ion-list inset>
        <ion-list-header>Basic</ion-list-header>
        <ion-accordion-group>
          <ion-accordion
            v-for="creator in creators"
            :key="creator.id"
          >
            <ion-item slot="header">
              <ion-label>{{ creator.name }} {{ creator.surname }}</ion-label>
            </ion-item>

            <ion-list slot="content">
              <ion-item
                v-for="catchPhrase in getCatchPhrasesByCreatorId(creator.id)"
                :key="catchPhrase.id"
                button
                @click="playAudio(catchPhrase)"
              >
                <ion-label>{{ catchPhrase.title }}</ion-label>
              </ion-item>
            </ion-list>
          </ion-accordion>
        </ion-accordion-group>
      </ion-list>
    </ion-content>
  </ion-page>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import {
	IonContent,
	IonPage,
	IonTitle,
	IonToolbar,
	IonHeader,
	IonAccordionGroup,
	IonLabel,
	IonList, IonItem, IonAccordion, IonListHeader
} from '@ionic/vue'
import {useCatchphrasesStore} from '@/store/catchphrases'
import {mapActions, mapState} from 'pinia'
import {print} from 'ionicons/icons'


export default defineComponent({
	components: {
		IonPage,
		IonContent,
		IonHeader,
		IonToolbar,
		IonTitle,
		IonAccordionGroup,
		IonAccordion,
		IonList,
		IonListHeader,
		IonItem,
		IonLabel
	},
	data() {
		return {
			currentAudio: new Audio()
		}
	},
	computed: {
		...mapState(useCatchphrasesStore, ['getCatchPhrasesByCreatorId', 'creators'])
	},
	async mounted() {
		await this.fetchCatchPhrases()
		console.log(this.getCatchPhrasesByCreatorId(1))
	},
	methods: {
		...mapActions(useCatchphrasesStore, ['fetchCatchPhrases']),
		playAudio(catchPhrase) {
			if(!this.currentAudio.paused) {
				this.currentAudio.pause()
			}
			this.currentAudio = new Audio(catchPhrase.audio)
			this.currentAudio.play()
		}
	}
})
</script>

<style scoped>
ion-content {
	--background: #f2f2f7;
}

ion-list-header {
	padding-bottom: 12px;
}
</style>
