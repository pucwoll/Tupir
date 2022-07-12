<?php namespace AppTupir\Catchphrase\Http\Resources;

use Illuminate\Support\Facades\Event;
use October\Rain\Support\Facades\Config;
use Illuminate\Http\Resources\Json\Resource;
use AppTupir\User\Http\Resources\SimpleUserResource;

class CatchphraseResource extends Resource
{
    public function toArray($request)

    {
        $response = [
            'type'        => 'catchphrase',
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'audio'       => url(Config::get('cms.storage.media.path')) . $this->audio,
            'lyrics'      => $this->lyrics,
            'tags_string' => $this->tags_string,
            'tags'        => $this->tags,
            'user'        => new SimpleUserResource($this->user),
            'order'       => $this->sort_order,
            'created_at'  => $this->created_at->toDateTimeString(),
            'updated_at'  => $this->updated_at->toDateTimeString(),
        ];

        Event::fire('apptupir.catchphrase.catchphrase.beforeReturnResource', [&$response, $this->resource]);

        return $response;
    }
}
