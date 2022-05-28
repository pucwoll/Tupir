import { defineStore } from 'pinia'
import axios from 'axios'

export const useCatchphrasesStore = defineStore({
	id: 'counter',
	state: () => ({
		catchPhrases: [],
		creators: []
	}),
	actions: {
		async fetchCatchPhrases() {
			const {data: catchPhrasesData} = await axios.get('https://tupir.wezeo.lol/cms/api/v1/catchphrases')
			this.catchPhrases = catchPhrasesData.data

			const {data: creatorsData} = await axios.get('https://tupir.wezeo.lol/cms/api/v1/creators')
			this.creators = creatorsData.data
		}
	},
	getters: {
		getCatchPhrasesByCreatorId: (state) => {
			return (creatorId: number) => state.catchPhrases.filter((catchphrase: Record<string, any>) => creatorId === catchphrase.user.id)
		}
	}
})
