export interface Catchphrase {
	type: string
	id: number
	title: string
	audio: string
	lyrics: string
	user: CatchphraseCreator
	order: null
	created_at: Date
	updated_at: Date
}

export interface CatchphraseCreator {
	type: string
	id: number
	name: string
	surname: string
	username: string
	description: string
	catchphrases_count: number
	avatar: Avatar
}

export interface Avatar {
	id: string
	disk_name: string
	file_name: string
	file_size: string
	content_type: string
	title: null
	description: null
	field: string
	sort_order: string
	created_at: Date
	updated_at: Date
	path: string
	extension: string
}
