<?php namespace LibUser\Device\Classes\Listen;

use Illuminate\Support\Facades\Event;

class UserApiListener {

    public static function init()
    {
        Event::listen('libuser.userapi.afterProcess', function($controller, $data){

            $deviceInfo = input('device');

            if ( !$deviceInfo ) {
                return;
            }

            $user = array_get($data, 'user');
            $user->devices()->create([
                'raw_data' => $deviceInfo
            ]);

        },1);
    }
}
