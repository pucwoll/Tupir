export interface Catchphrase {
	id: number
	title: string
	slug: string
	audio: string
	lyrics: string
	tags_string: null | string
	tags: null | Array<string>
	user: CatchphraseUser
	created_at: Date
	updated_at: Date
  likes: number
  bookmarks: number
  shares: number
  comments: number
  score: number
  like_by_active_user: boolean
  bookmark_by_active_user: boolean
  share_by_active_user: boolean
  comment_by_active_user: boolean
}

export interface CatchphraseUser {
	id: number
	name: string
	username: string
	bio: string
	catchphrases_count: number
	avatar: Avatar
	user_role: string
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
