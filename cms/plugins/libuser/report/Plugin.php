<?php namespace LibUser\Report;

use Backend\Facades\Backend;
use System\Classes\PluginBase;
use LibUser\Report\Classes\Extend\UserExtend;

/**
 * Report Plugin Information File
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
            'name' => 'Report',
            'description' => 'No description provided yet...',
            'author' => 'LibUser',
            'icon' => 'icon-exclamation-triangle'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        UserExtend::addReportsRelationToUser();
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'libuser.report.manage' => [
                'tab' => 'Report',
                'label' => 'Manage'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'report' => [
                'label' => 'Reports',
                'url' => Backend::url('libuser/report/userreports'),
                'icon' => 'icon-exclamation-triangle',
                'permissions' => ['libuser.report.*'],
                'order' => 500,
            ],
        ];
    }
}
