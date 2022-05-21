<?php namespace Libuser\Userapi\Http\Resources;

use Illuminate\Support\Facades\Event;
use Illuminate\Http\Resources\Json\Resource;
use AppTupir\Catchphrase\Models\Catchphrase;

class SimpleUserResource extends Resource
{
    public function toArray($request)

    {
        $response = [
            'type'         => "creator",
            'id'           => $this->id,
            'name'         => $this->name,
            'surname'      => $this->surname,
            'username'     => $this->username,
            'email'        => $this->email,
            'catchphrases' => Catchphrase::isPublished()->where('user_id', $this->id)->count(),
            'avatar'       => $this->avatar,
        ];

        return $response;
    }
}




