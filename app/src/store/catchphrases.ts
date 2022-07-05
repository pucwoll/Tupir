import { defineStore } from 'pinia'
import axios from 'axios'
import type { Catchphrase, CatchphraseCreator } from '@/interfaces/catchphrases'

interface CatchphrasesStore {
	catchphrases: Catchphrase[]
	creators: CatchphraseCreator[]
}

export const useCatchphrasesStore = defineStore('catchphrases',{
  state: (): CatchphrasesStore => ({
    catchphrases: [],
    creators: []
  }),
  actions: {
    async fetchCatchphrases() {
      const { data: catchphrasesData } = await axios.get(`${import.meta.env.VITE_API_URL}/catchphrases`)
      this.catchphrases = catchphrasesData.data

      const { data: creatorsData } = await axios.get(`${import.meta.env.VITE_API_URL}/creators`)
      this.creators = creatorsData.data
    }
  },
  getters: {
    getCatchphrasesByCreatorId: (state) => {
      return (creatorId: number): Catchphrase[] => state.catchphrases.filter((catchphrase) => creatorId === catchphrase.user.id)
    }
  }
})
