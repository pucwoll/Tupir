<?php namespace LibChat\Comments\Classes\Extend;

use RainLab\User\Models\User;
use LibChat\Comments\Models\Comment;

class UserExtend
{
    public static function addCommentRelationToUser()
    {
        User::extend(function (User $user) {
            $user->morphMany['comments'] = [
                Comment::class,
                'name'       => 'creatable',
                'softDelete' => true,
                'delete'     => true
            ];
        });
    }
}
