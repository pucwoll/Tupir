<?php namespace LibUser\UserFlag\Http\Resources;

use Illuminate\Support\Facades\Event;
use Illuminate\Http\Resources\Json\Resource;
use LibUser\UserApi\Http\Resources\UserResource;
use LibUser\UserFlag\Classes\Services\UserFlagService;

class UserFlagResource extends Resource
{
    public function toArray($request)
    {

        $flaggableResource = UserFlagService::getResourceClass_byModelClass(get_class($this->flaggable));

        $data = [
            'id'         => $this->id,
            'type'       => $this->type,
            'text'       => $this->text,
            'value'      => (int) $this->value,
            'user'       => new UserResource($this->user),
            'flaggable'  => new $flaggableResource($this->flaggable),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];

        Event::fire('libuser.userflag.userflag.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
