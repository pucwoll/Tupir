<?php namespace LibUser\Profile\Http\Resources;

use Illuminate\Support\Facades\Event;
use Illuminate\Http\Resources\Json\Resource;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class ProfileResource extends Resource
{
    public function toArray($request)
    {
        $response = [
            'id'                 => $this->id,
            'name'               => $this->name,
            'username'           => $this->username,
			'user_role'          => $this->user_role,
            'bio'                => $this->bio,
            'avatar'             => $this->avatar,
            'following'          => ProfileSimpleResource::collection(
                $this->following->pluck('flaggable')->filter()
            ),
            'following_count'    => $this->following_count,
            'followers'          => ProfileSimpleResource::collection(
                $this->followers->pluck('user')->filter()
            ),
            'followers_count'    => $this->followers_count,
            'catchphrases'       => CatchphraseResource::collection(
                $this->catchphrases()->where('is_published', true)->get()
            ),
            'catchphrases_count' => $this->catchphrases_count
        ];

        Event::fire('libuser.profile.profile.beforeReturnResource', [&$response, $this->resource]);

        return $response;
    }
}
