<?php namespace LibUser\Profile\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProfileSimpleResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'                 => $this->id,
            'name'               => $this->name,
            'username'           => $this->nickname,
            'bio'                => $this->bio,
            'avatar'             => $this->avatar,
            'user_role'          => $this->user_role,
            'following_count'    => $this->following_count,
            'followers_count'    => $this->followers_count,
            'catchphrases_count' => $this->catchphrases_count
        ];
    }
}
