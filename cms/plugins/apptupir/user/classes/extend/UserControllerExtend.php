<?php namespace AppTupir\User\Classes\Extend;

use RainLab\User\Models\User;
use RainLab\User\Facades\Auth;
use October\Rain\Support\Facades\Event;

class UserControllerExtend
{
    public static function enableUsernameAuth()
    {
        Event::listen('libuser.userapi.beforeAuthenticate', function ($params) {
            $params['login'] = User::firstOrFail()
                ->where('email', $params['login'])
                ->orWhere('username', $params['login'])
                ->value('email');

            if (isset($params['login'])) {
                return Auth::authenticate($params, false);
            }
        });
    }
}
