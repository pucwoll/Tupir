<?php namespace LibUser\UserFlag;

use Backend;
use System\Classes\PluginBase;
use LibUser\UserFlag\Classes\Extend\UserExtend;

/**
 * UserFlag Plugin Information File
 */
class Plugin extends PluginBase
{
    /*
     * Dependencies
     */
    public $require = [
        'WApi.ApiException',
        'LibUser.UserApi'
    ];
    /*
     * Returns information about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'UserFlag',
            'description' => 'No description provided yet...',
            'author'      => 'LibUser',
            'icon'        => 'icon-leaf'
        ];
    }

    /*
     * Bootstrap plugin
     */
    public function boot()
    {
        UserExtend::addMethod_getFlaggedModels();
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'userflag' => [
                'label'       => 'User flags',
                'url'         => Backend::url('libuser/userflag/userflags'),
                'icon'        => 'icon-flag',
                'permissions' => ['libuser.userflag.*'],
                'order'       => 500
            ]
        ];
    }
}
