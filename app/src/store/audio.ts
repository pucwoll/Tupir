import { defineStore } from 'pinia'

interface AudioStore {
	currentAudio?: HTMLAudioElement
}

export const useAudioStore = defineStore('audio',{
  state: (): AudioStore => ({
    currentAudio: undefined
  }),
})
