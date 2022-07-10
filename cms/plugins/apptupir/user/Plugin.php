<?php namespace AppTupir\User;

use Backend;
use System\Classes\PluginBase;
use AppTupir\User\Classes\Extend\UserExtend;
use AppTupir\User\Classes\Extend\UserExtendDefaultAssets;
use AppTupir\User\Classes\Extend\UserExtendCatchphrasesCount;

/**
 * User Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'RainLab.User',
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
        UserExtend::extendUserResource();
        UserExtend::updateFormFields_addUsernameField();
        UserExtend::updateFormFields_addBioField();
        UserExtend::updateFormFields_addSuperUserSwitch();
        UserExtend::addBioAsFillableToUser();

        UserExtendCatchphrasesCount::addCatchphrasesCountToColumns();
        UserExtendCatchphrasesCount::addCatchphrasesCountToResource();

        UserExtend::onScopeCanSee_filterPublished();
        UserExtend::addIsPublishedScope();
        UserExtend::addIsPublishedAsFillable();
        UserExtend::updateListColumns_addIsPublishedSwitch();
        UserExtend::updateFormFields_addIsPublishedSwitch();

        UserExtendDefaultAssets::beforeSave_setDefaultAvatar();
    }
}
