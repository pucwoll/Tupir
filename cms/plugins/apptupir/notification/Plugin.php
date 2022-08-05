<?php namespace AppTupir\Notification;

use Backend;
use System\Classes\PluginBase;
use AppTupir\Notification\Classes\Hooks\NotificationsHooks;

/**
 * Notification Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Notification',
            'description' => 'No description provided yet...',
            'author'      => 'AppGamemakers',
            'icon'        => 'icon-leaf'
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
        NotificationsHooks::afterCommentCreate();
        NotificationsHooks::afterFollowCreated();
        NotificationsHooks::afterCatchphraseCreate();
    }
}
