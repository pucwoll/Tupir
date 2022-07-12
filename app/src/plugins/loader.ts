import { loadingController } from '@ionic/vue';

export default {
	_isLoading: false,
	loader: null,

	isLoading() {
		return this._isLoading
	},

	async startLoading(text='Loading') {
		this._isLoading = true

		this.loader = await loadingController
			.create({
				message: text
			})

		this.loader.present()
	},

	async clearLoading() {
		this._isLoading = false
		await this.loader.dismiss()
	}
}
