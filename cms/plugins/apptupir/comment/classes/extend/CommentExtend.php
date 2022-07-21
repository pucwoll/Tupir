<?php namespace AppTupir\Comment\Classes\Extend;

use LibChat\Comments\Models\Comment;
use LibUser\UserFlag\Models\UserFlag;
use Illuminate\Support\Facades\Event;

class CommentExtend
{
    public static function extendAuthorResource_addAvatar()
    {
        Event::listen('libchat.comments.author.beforeReturnResource', function(&$response, $model) {
            $response['avatar'] = $model->avatar;
        });
    }

    public static function addLikesRelationToComment()
    {
        Comment::extend(function (Comment $comment) {
            $comment->morphMany['likes'] = [
                UserFlag::class,
                'name'       => 'flaggable',
                'conditions' => 'type = "like"'
            ];
        });
    }

    public static function beforeDelete_deleteLikes()
    {
        Comment::extend(function (Comment $comment) {
            $comment->bindEvent('model.beforeDelete', function () use ($comment) {
                if ($comment->forceDeleting) {
                    $comment->likes()->forceDelete();
                } else {
                    $comment->likes()->delete();
                }
            });
        });
    }

    public static function afterRestore_restoreLikes()
    {
        Comment::extend(function (Comment $comment) {
            $comment->bindEvent('model.afterRestore', function () use ($comment) {
                $comment->likes()->restore();
            });
        });
    }

    public static function extendCommentResource_addLikesCount()
    {
        Event::listen('libchat.comments.comment.beforeReturnResource', function(&$response, Comment $comment) {
            $response['likes'] = UserFlag::where([
                'flaggable_id'   => $comment->id,
                'flaggable_type' => Comment::class,
                'type'          => 'like',
                'value'         => 1
            ])->count();
        });
    }

    public static function extendAnswerResource_addLikesCount()
    {
        Event::listen('libchat.comments.answer.beforeReturnResource', function(&$response, Comment $comment) {
            $response['likes'] = UserFlag::where([
                'flaggable_id'   => $comment->id,
                'flaggable_type' => Comment::class,
                'type'          => 'like',
                'value'         => 1
            ])->count();
        });
    }
}
