<?php namespace AppTupir\User;

use Backend;
use System\Classes\PluginBase;
use AppTupir\User\Classes\Extend\UserExtendCreator;
use AppTupir\User\Classes\Extend\UserExtendDescription;
use AppTupir\User\Classes\Extend\UserExtendCatchphrasesCount;

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
        UserExtendCreator::addCreatorToFields();
        UserExtendCreator::addCreatorToColumns();
        UserExtendCreator::addCreatorToResource();
        UserExtendDescription::addDescriptionToFields();
        UserExtendDescription::addDescriptionToResource();
        UserExtendCatchphrasesCount::addCatchphrasesCountToColumns();
        UserExtendCatchphrasesCount::addCatchphrasesCountToResource();
    }
}
