<?php namespace AppTupir\User\Classes\Extend;

use RainLab\User\Models\User;
use LibUser\UserFlag\Models\UserFlag;

class UserFlagExtend
{
    public static function addUserToAliasesConfig()
    {
        config([
            'libuser.userflag::aliases.user' => [
                'model'    => 'RainLab\User\Models\User',
                'resource' => 'LibUser\UserApi\Http\Resources\UserResource'
            ],
        ]);
    }

    public static function softDeleteUserFlagsOnUserDeleteAndRestore()
    {
        User::extend(function (User $user) {
            $user->bindEvent('model.beforeDelete', function () use ($user) {
                UserFlag::where('user_id', $user->id)
                    ->orWhere(function ($query) use ($user) {
                        $query->where([
                            'flaggable_type' => 'RainLab\User\Models\User',
                            'flaggable_id'   => $user->id
                        ]);
                    })
                    ->delete();
            });

            $user->bindEvent('model.afterRestore', function () use ($user) {
                UserFlag::onlyTrashed()
                    ->where('user_id', $user->id)
                    ->orWhere(function ($query) use ($user) {
                        $query->where([
                            'flaggable_type' => 'RainLab\User\Models\User',
                            'flaggable_id'   => $user->id
                        ]);
                    })
                    ->restore();
            });
        });
    }
}
