<?php namespace LibUser\Profile\Http\Resources;

use RainLab\User\Models\User;
use Illuminate\Http\Resources\Json\Resource;

class ProfileSimpleResource extends Resource
{
    public function toArray($request)
    {
        return [
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
            'following_count'    => $this->following_count,
            'followers_count'    => $this->followers_count,
            'catchphrases_count' => $this->catchphrases_count
        ];
    }
}
