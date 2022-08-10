<?php namespace AppTupir\User\Classes\Extend;

use RainLab\User\Models\User;
use RainLab\User\Facades\Auth;
use October\Rain\Support\Facades\Event;

class UsersControllerExtend
{
    public static function enableUsernameAuth()
    {
        Event::listen('libuser.userapi.beforeAuthenticate', function ($params) {
            $params['login'] = User::isActivated()
                ->where('email', $params['login'])
                ->orWhere('username', $params['login'])
                ->value('email');

            return Auth::authenticate($params, false);
        });
    }
}
