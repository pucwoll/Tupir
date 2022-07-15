<?php namespace LibUser\Profile;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $require = [
        'RainLab.User',
        'WApi.ApiException',
        'LibUser.UserApi',
        'LibUser.Block'
    ];

    public function pluginDetails()
    {
        return [
            'name' => 'Profile',
            'description' => 'No description provided yet...',
            'author' => 'LibUser',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }
}
