import { defineStore } from 'pinia'
import axios from 'axios'
import type { Catchphrase, CatchphraseUser } from '@/interfaces/catchphrases'

interface CatchphrasesStore {
	catchphrases: Catchphrase[]
	users: CatchphraseUser[]
}

export const useCatchphrasesStore = defineStore('catchphrases',{
  state: (): CatchphrasesStore => ({
    catchphrases: [],
    users: []
  }),
  actions: {
    async fetchCatchphrases() {
      const { data: catchphrasesData } = await axios.get(`${import.meta.env.VITE_API_URL}/catchphrases`)
      this.catchphrases = catchphrasesData.data

      const { data: usersData } = await axios.get(`${import.meta.env.VITE_API_URL}/users`)
      this.users = usersData.data
    }
  },
  getters: {
    getCatchphrasesByUserId: (state) => {
      return (userId: number): Catchphrase[] => state.catchphrases.filter((catchphrase) => userId === catchphrase.user.id)
    }
  }
})
