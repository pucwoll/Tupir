<?php namespace LibChat\Comments\Http\Resources;

use Illuminate\Support\Facades\Event;
use Illuminate\Http\Resources\Json\Resource;

class AuthorResource extends Resource
{
    public function toArray($request)
    {
        $data = [
            'id'       => $this->id,
            'name'     => $this->name,
            'username' => $this->username
        ];

        Event::fire('libchat.comments.author.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
