<?php namespace AppTupir\Comment\Classes\Extend;

use Illuminate\Support\Facades\Event;

class CommentExtend
{
    public static function extendCommentResource()
    {
        Event::listen('libchat.comments.author.beforeReturnResource', function(&$data, $model) {
            $data['avatar'] = $model->avatar;
        });
    }
}
