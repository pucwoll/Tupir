<?php namespace LibUser\Device\Classes\Extend;

use RainLab\User\Models\User;
use LibUser\Device\Models\Device;

class UserExtend {

    public static function init()
    {
        User::extend(function($model){
            $model->hasMany['devices'] = Device::class;
        });
    }
}
