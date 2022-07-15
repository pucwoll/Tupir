<?php namespace LibUser\Block;

use Backend\Facades\Backend;
use System\Classes\PluginBase;
use LibUser\Block\Classes\Extend\UserExtend;

/**
 * Block Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'RainLab.User'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Block',
            'description' => 'No description provided yet...',
            'author' => 'LibUser',
            'icon' => 'icon-ban'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        UserExtend::addBlockedUserRelation();
        UserExtend::addScopeCanSee();

        UserExtend::beforeReturnUser();
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'libuser.block.manage' => [
                'tab' => 'Block',
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
            'block' => [
                'label' => 'Blocks',
                'url' => Backend::url('libuser/block/userblocks'),
                'icon' => 'icon-ban',
                'permissions' => ['libuser.block.*'],
                'order' => 600,
            ],
        ];
    }
}
