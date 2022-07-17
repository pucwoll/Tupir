<?php namespace LibUser\Profile\Http\Resources;

use RainLab\User\Models\User;
use Illuminate\Support\Facades\Event;
use October\Rain\Support\Facades\Input;
use Illuminate\Http\Resources\Json\Resource;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class ProfileResource extends Resource
{
    public function toArray($request)
    {
        $sortType = Input::get('sort_type');

        $response = [
            'id'                 => $this->id,
            'name'               => $this->name,
            'username'           => $this->username,
			'user_role'          => $this->user_role,
            'bio'                => $this->bio,
            'avatar'             => $this->avatar,
            'likes_count'        => User::isPublished()
                ->where('id', $this->id)
                ->withCount('likes')
                ->get()
                ->sum('likes_count'),
            'following'          => ProfileSimpleResource::collection(
                $this->following
                    ->pluck('flaggable')
                    ->filter()
            ),
            'following_count'    => $this->following
                ->pluck('flaggable')
                ->filter()
                ->count(),
            'followers'          => ProfileSimpleResource::collection(
                $this->followers
                    ->pluck('user')
                    ->filter()
            ),
            'followers_count'    => $this->followers
                ->pluck('user')
                ->filter()
                ->count(),
            'catchphrases'       => CatchphraseResource::collection(
                Catchphrase::isPublished()
                    ->where('user_id', $this->id)
                    ->orderByDesc('created_at')
                    ->get()
            ),
            'catchphrases_count' => $this->catchphrases()
                ->where('is_published', true)
                ->get()
                ->count()
        ];

        if ($sortType === 'newest') {
            $response['catchphrases'] = CatchphraseResource::collection(
                Catchphrase::isPublished()
                    ->where('user_id', $this->id)
                    ->orderByDesc('created_at')
                    ->get()
            );
        }
        else if ($sortType === 'most_liked') {
            $response['catchphrases'] = CatchphraseResource::collection(
                Catchphrase::isPublished()
                    ->where('user_id', $this->id)
                    ->withCount('likes')
                    ->orderByDesc('likes_count')
                    ->orderByDesc('created_at')
                    ->get()
            );
        }
        else if ($sortType === 'most_discussed') {
            $response['catchphrases'] = CatchphraseResource::collection(
                Catchphrase::isPublished()
                    ->where('user_id', $this->id)
                    ->withCount('comments')
                    ->orderByDesc('comments_count')
                    ->orderByDesc('created_at')
                    ->get()
            );
        }
        else if ($sortType === 'most_played') {
            $response['catchphrases'] = CatchphraseResource::collection(
                Catchphrase::isPublished()
                    ->where('user_id', $this->id)
                    ->withCount('plays')
                    ->orderByDesc('plays_count')
                    ->orderByDesc('created_at')
                    ->get()
            );
        }

        Event::fire('libuser.profile.profile.beforeReturnResource', [&$response, $this->resource]);

        return $response;
    }
}
