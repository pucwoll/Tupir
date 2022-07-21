<?php namespace AppTupir\Comment;

use Backend;
use System\Classes\PluginBase;
use AppTupir\Comment\Classes\Extend\CommentExtend;
use LibUser\UserFlag\Classes\Services\UserFlagService;

/**
 * Comment Plugin Information File
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
            'name'        => 'Comment',
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
        CommentExtend::extendAuthorResource_addAvatar();

        CommentExtend::addLikesRelationToComment();

        CommentExtend::beforeDelete_deleteLikes();
        CommentExtend::afterRestore_restoreLikes();

        CommentExtend::extendCommentResource_addLikesCount();
        CommentExtend::extendAnswerResource_addLikesCount();

        UserFlagService::addTypeStatusToResource('libchat.comments.comment.beforeReturnResource', 'like', 'like_by_active_user');
        UserFlagService::addTypeStatusToResource('libchat.comments.answer.beforeReturnResource', 'like', 'like_by_active_user');
    }
}
