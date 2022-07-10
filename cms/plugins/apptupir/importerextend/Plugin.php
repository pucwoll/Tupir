<?php namespace AppMemeTime\ImporterExtend;

use System\Classes\PluginBase;
use AppMemeTime\ImporterExtend\Classes\Hooks\ImporterHook;

/**
 * ImporterExtend Plugin Information File
 */
class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'ImporterExtend',
            'description' => 'No description provided yet...',
            'author' => 'AppMemeTime',
            'icon' => 'icon-leaf',
        ];
    }

    public function boot()
    {
        ImporterHook::beforeSave_setIsPublishedAndThumbnail();
    }
}
