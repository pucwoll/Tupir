<?php namespace LibUser\UserFlag\Classes\Services;

use October\Rain\Database\Model;
use LibUser\UserApi\Facades\JWTAuth;
use Illuminate\Support\Facades\Event;
use LibUser\UserFlag\Models\UserFlag;

class UserFlagService
{
    /*
     * Add type statuses to resource
     */
    public static function addTypeStatusToResource($eventName, $type, $resourceTypeName)
    {
        Event::listen($eventName, function(&$data, Model $model) use ($type, $resourceTypeName) {
            $user = JWTAuth::getUser();

            $typeStatus = null;

            if ($user) {
                $flag = UserFlag::where([
                    'user_id'        => $user->id,
                    'type'           => $type,
                    'flaggable_type' => $model->getMorphClass(),
                    'flaggable_id'   => $model->id,
                ])->first();
                $typeStatus = (boolean) ($flag->value ?? false);
            }

            $data[$resourceTypeName] = $typeStatus;
        });
    }

    /*
     * Get Resource class if model class is provided
     */
    public static function getResourceClass_byModelClass($modelClass)
    {
        $aliases = collect(config('libuser.userflag::aliases'))->map(function($config) {
            return $config['model'];
        })->flip();

        return config('libuser.userflag::aliases.' . $aliases[$modelClass] . '.resource');
    }
}
