<?php namespace LibUser\UserApi\Classes;

use Illuminate\Support\Facades\Event;

class UserApiHook
{
    public static function hook($hook, $data, $callback)
    {
        $hook = Event::fire(sprintf('libuser.userapi.%s', $hook), $data, true);
        if (!is_null($hook)) {
            return $hook;
        }

        return $callback();
    }
}
