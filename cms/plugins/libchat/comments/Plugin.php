<?php namespace LibChat\Comments;

use Backend\Facades\Backend;
use System\Classes\PluginBase;
use LibChat\Comments\Classes\Extend\UserExtend;

/**
 * WallPostComment Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'WApi.ApiException',
        'LibUser.UserApi',
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Comment',
            'description' => 'No description provided yet...',
            'author'      => 'LibChat',
            'icon'        => 'icon-comments',
        ];
    }

    public function boot()
    {
        UserExtend::addCommentRelationToUser();
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'comments' => [
                'label' => 'Comments',
                'url' => Backend::url('libchat/comments/comments'),
                'icon' => 'icon-comments',
                'permissions' => ['libchat.comment.*'],
                'order' => 500,
            ],
        ];
    }
}
