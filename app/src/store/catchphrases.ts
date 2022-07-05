import { defineStore } from 'pinia'
import axios from 'axios'
import type { Catchphrase, Creator } from '@/interfaces/catchphrases'

export const useCatchphrasesStore = defineStore('counter',{
  state: () => ({
    catchphrases: [] as Catchphrase[],
    creators: [] as Creator[]
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
      return (creatorId: number) => state.catchphrases.filter((catchphrase) => creatorId === catchphrase.user.id)
    }
  }
})
