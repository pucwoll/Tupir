<?php namespace LibUser\Device;

use System\Classes\PluginBase;
use LibUser\Device\Classes\Extend\UserExtend;
use LibUser\Device\Classes\Listen\UserApiListener;

/**
 * Device Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'LibUser.UserApi'
    ];
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Device',
            'description' => 'No description provided yet...',
            'author' => 'LibUser',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        UserExtend::init();
        UserApiListener::init();
    }
}
