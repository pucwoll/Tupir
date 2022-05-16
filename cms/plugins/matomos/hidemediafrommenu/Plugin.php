<?php namespace Matomos\HideMediaFromMenu;

use Backend;
use October\Rain\Support\Facades\Event;
use System\Classes\PluginBase;

/**
 * HideMediaFromMenu Plugin Information File
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
            'name'        => 'HideMediaFromMenu',
            'description' => 'No description provided yet...',
            'author'      => 'Matomos',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        Event::listen('backend.menu.extendItems', function ($navigationManager) {
            $navigationManager->removeMainMenuItem('October.Backend', 'media');
        });
    }
}
