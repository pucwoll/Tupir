<?php namespace AppTupir\User\Classes\Extend;

use RainLab\User\Models\User;
use RainLab\User\Facades\Auth;
use October\Rain\Support\Facades\Event;

class UserLoginApiControllerExtend
{
    public static function enableUsernameAuth()
    {
        Event::listen('libuser.userapi.beforeAuthenticate', function ($params) {
            $remember = (bool) array_get($params, 'remember', false);

            $params['login'] = User::firstOrFail()
                ->where('email', $params['login'])
                ->orWhere('username', $params['login'])
                ->value('email');

            if (isset($params['login'])) {
                return Auth::authenticate([
                    'login' => $params['login'],
                    'password' => $params['password']
                ], $remember);
            }
        });
    }
}
