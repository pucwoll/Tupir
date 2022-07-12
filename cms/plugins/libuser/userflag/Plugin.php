<?php namespace LibUser\UserFlag;

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
}
