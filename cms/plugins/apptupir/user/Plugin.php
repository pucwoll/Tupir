<?php namespace AppTupir\User;

use Backend;
use System\Classes\PluginBase;
use AppTupir\User\Classes\Extend\UserExtend;
use AppTupir\User\Classes\Extend\UserFlagExtend;
use LibUser\UserFlag\Classes\Services\UserFlagService;
use AppTupir\User\Classes\Extend\UserExtendDefaultAssets;

/**
 * User Plugin Information File
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

        UserExtend::addFollowingRelationToUser();
        UserExtend::addFollowersRelationToUser();
        UserExtend::addLikesRelationToUser();
        UserExtend::addBookmarksRelationToUser();
        UserExtend::addCommentsRelationToUser();
        UserExtend::addSharesRelationToUser();
        UserExtend::addPlaysRelationToUser();
        UserExtend::addCatchphraseRelationToUser();

        UserExtend::onScopeCanSee_filterPublished();
        UserExtend::addIsPublishedScope();
        UserExtend::addIsPublishedAsFillable();
        UserExtend::updateListColumns_addIsPublishedSwitch();
        UserExtend::updateFormFields_addIsPublishedSwitch();
        UserExtend::deleteUserFlags_onUserDelete();
        UserExtend::beforeShowCatchphrase_checkPublished();
        UserExtend::addCatchphrasesCountToColumns();
        UserExtend::addCatchphrasesCountToResource();

        UserExtendDefaultAssets::beforeSave_setDefaultAvatar();

        UserFlagExtend::addUserToAliasesConfig();
        UserFlagExtend::softDeleteUserFlagsOnUserDeleteAndRestore();
        UserFlagService::addTypeStatusToResource('libuser.profile.profile.beforeReturnResource', 'follow', 'is_followed_by_active_user');
    }
}
