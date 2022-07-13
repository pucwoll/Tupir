import { defineStore } from 'pinia'
import axios from 'axios'
import type { Catchphrase, CatchphraseUser } from '@/interfaces/catchphrases'

import CatchphrasesMock  from '@/assets/mocks/catchphrases.json'
import UsersMock  from '@/assets/mocks/catchphrases.json'

interface CatchphrasesStore {
	catchphrases: Catchphrase[]
	users: CatchphraseUser[]
}

export const useCatchphrasesStore = defineStore('catchphrases',{
  state: (): CatchphrasesStore => ({
    catchphrases: CatchphrasesMock as Catchphrase[],
    users: UsersMock as CatchphraseUser[]
  }),
  actions: {
    async fetchCatchphrases() {
      // const { data: catchphrasesData } = await axios.get(`${import.meta.env.VITE_API_URL}/catchphrases`)
      // this.catchphrases = catchphrasesData.data
      //
      // const { data: usersData } = await axios.get(`${import.meta.env.VITE_API_URL}/users`)
      // this.users = usersData.data
    }
  },
  getters: {
    getCatchphrasesByUserId: (state) => {
      return (userId: number): Catchphrase[] => state.catchphrases.filter((catchphrase) => userId === catchphrase.user.id)
    }
  }
})
