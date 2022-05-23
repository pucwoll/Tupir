<?php namespace AppTupir\User;

use AppTupir\User\Classes\Extend\UserExtendCatchphrasesCount;
use Backend;
use System\Classes\PluginBase;
use AppTupir\User\Classes\Extend\UserExtendCreator;

/**
 * User Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        "RainLab.User",
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'User',
            'description' => 'No description provided yet...',
            'author'      => 'AppTupir',
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
        UserExtendCatchphrasesCount::addCatchphrasesCountToColumns();
        UserExtendCatchphrasesCount::addCatchphrasesCountToResource();
        UserExtendCreator::addCreatorToFields();
        UserExtendCreator::addCreatorToColumns();
        UserExtendCreator::addCreatorToResource();
    }
}
