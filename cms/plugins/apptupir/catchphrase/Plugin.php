<?php namespace AppTupir\Catchphrase;

use Backend;
use System\Classes\PluginBase;
use Illuminate\Contracts\Http\Kernel;
use LibUser\UserApi\Http\Middlewares\Check;
use LibUser\UserFlag\Classes\Services\UserFlagService;
use AppTupir\Catchphrase\Classes\Extend\UserFlagExtend;
use AppTupir\Catchphrase\Classes\Extend\CatchphraseExtend;

/**
 * Project Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'RainLab.User',
        'LibUser.UserApi',
        'LibUser.UserFlag'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Catchphrase',
            'description' => 'No description provided yet...',
            'author'      => 'AppTupir',
            'icon'        => 'icon-commenting'
        ];
    }

    public function register()
    {
        $this->app[Kernel::class]->pushMiddleware(Check::class);
    }

    public function boot()
    {
        UserFlagExtend::addPostToAliasesConfig();

        CatchphraseExtend::addLikesRelationToCatchphrase();
        CatchphraseExtend::addPlaysRelationToCatchphrase();
        CatchphraseExtend::addVisitsRelationToCatchphrase();
        CatchphraseExtend::addSharesRelationToCatchphrase();
        CatchphraseExtend::addCommentsRelationToCatchphrase();
        CatchphraseExtend::addBookmarksRelationToCatchphrase();

        CatchphraseExtend::beforeDelete_deletePlaysLikesBookmarksSharesComments();
        CatchphraseExtend::afterRestore_restorePlaysVisitsLikesBookmarksSharesComments();

        CatchphraseExtend::updateResource_addPlaysVisitsLikesBookmarksSharesCommentsCount();
        CatchphraseExtend::bindEvent_createVisitFlagWhenSpecificCatchphraseIsRequested();

        UserFlagService::addTypeStatusToResource('apptupir.catchphrase.catchphrase.beforeReturnResource', 'like', 'like_by_active_user');
        UserFlagService::addTypeStatusToResource('apptupir.catchphrase.catchphrase.beforeReturnResource', 'bookmark', 'bookmark_by_active_user');
        UserFlagService::addTypeStatusToResource('apptupir.catchphrase.catchphrase.beforeReturnResource', 'share', 'share_by_active_user');
        UserFlagService::addTypeStatusToResource('apptupir.catchphrase.catchphrase.beforeReturnResource', 'comment', 'comment_by_active_user');
        UserFlagService::addTypeStatusToResource('apptupir.catchphrase.catchphrase.beforeReturnResource', 'play', 'play_by_active_user');
        UserFlagService::addTypeStatusToResource('apptupir.catchphrase.catchphrase.beforeReturnResource', 'visit', 'visit_by_active_user');
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'catchphrase' => [
                'label' => 'Catchphrases',
                'url'   => Backend::url('apptupir/catchphrase/catchphrases'),
                'icon'  => 'icon-commenting',
                'order' => 500,
            ],
        ];
    }
}
