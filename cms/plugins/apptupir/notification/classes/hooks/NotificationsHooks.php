<?php namespace AppTupir\Notification\Classes\Hooks;

use RainLab\User\Models\User;
use LibChat\Comments\Models\Comment;
use LibUser\UserFlag\Models\UserFlag;
use Illuminate\Support\Facades\Notification;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\Notification\Classes\PushNotifications\NewCommentNotification;
use AppTupir\Notification\Classes\PushNotifications\NewFollowersNotification;
use AppTupir\Notification\Classes\PushNotifications\NewCatchphraseNotification;

class NotificationsHooks
{
    public static function afterCatchphraseCreate()
    {
        Catchphrase::extend(function (Catchphrase $catchphrase) {
            $catchphrase->bindEvent('model.afterCreate', function () use ($catchphrase) {
                $catchphrase->user->followers->pluck('user')->filter()->unique()->each(function (User $user) use ($catchphrase) {
                    Notification::send($user, new NewCatchphraseNotification($catchphrase));
                });
            });
        });
    }

    public static function afterCommentCreate()
    {
        Comment::extend(function (Comment $comment) {
            $comment->bindEvent('model.afterCreate', function () use ($comment) {
                $catchphraseId = $comment->commentable->id;

                $usersLikedCatchphrases = UserFlag::where('flaggable_type', Catchphrase::class)
                    ->where('flaggable_id', $catchphraseId)
                    ->where('type', 'like')
                    ->where('value', 1)
                    ->with('user')
                    ->get()
                    ->pluck('user')
                    ->filter();

                $usersCommentedCatchphrases = Comment::where('commentable_type', Catchphrase::class)
                    ->where('commentable_id', $catchphraseId)
                    ->with('creatable')
                    ->get()
                    ->pluck('creatable')
                    ->filter();

                $users = $usersLikedCatchphrases->merge($usersCommentedCatchphrases)->unique();

                $users->each(function ($user) use ($comment) {
                    if ($user->id == $comment->creatable->id) {
                        return;
                    }

                    Notification::send($user, new NewCommentNotification($comment));
                });
            });
        });
    }

    public static function afterFollowCreated()
    {
        UserFlag::extend(function ($userFlag) {
            $userFlag->bindEvent('model.afterCreate', function () use ($userFlag) {
                if ($userFlag->type != 'follow' || $userFlag->flaggable_type != User::class) {
                    return;
                }

                Notification::send($userFlag->flaggable, new NewFollowersNotification($userFlag->user));
            });
        });
    }
}
