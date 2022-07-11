<?php namespace LibUser\Role;

use System\Classes\PluginBase;
use LibUser\Role\Classes\Extend\UserExtend;

/**
 * Role Plugin Information File
 */
class Plugin extends PluginBase
{
    /*
     * Dependencies
     */
    public $require = [
        'RainLab.User',
    ];
    
    /*
     * Returns information about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Role',
            'description' => 'No description provided yet...',
            'author'      => 'LibUser',
            'icon'        => 'icon-leaf',
        ];
    }
    
    /*
     * Boot method, called right before the request route.
     */
    public function boot()
    {
        UserExtend::addRules_userRoleIsInDefinedConfig();
        UserExtend::updateFormFields_addSelectorForUserRoles();
        UserExtend::updateResource_addUserRole();
    }
}
