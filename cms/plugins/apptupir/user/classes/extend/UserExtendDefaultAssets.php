<?php namespace AppTupir\User\Classes\Extend;

use Rainlab\User\Models\User;

class UserExtendDefaultAssets
{
    public static function beforeSave_setDefaultAvatar()
    {
        User::extend(function (User $user) {
            $user->bindEvent('model.beforeCreate', function () use ($user) {
                if (!$user->avatar) {
                    $user->avatar = (new \System\Models\File())->fromFile(plugins_path('apptupir/user/assets/avatar/avatar.png'));
                }
            });
        });
    }
}
