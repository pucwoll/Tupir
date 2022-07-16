<?php namespace AppTupir\Catchphrase\Classes\Extend;

use LibUser\UserFlag\Models\UserFlag;
use Illuminate\Support\Facades\Event;
use AppTupir\Catchphrase\Models\Catchphrase;

class CatchphraseExtend
{
    public static function addLikesRelationToCatchphrase()
    {
        Catchphrase::extend(function (Catchphrase $catchphrase) {
            $catchphrase->morphMany['likes'] = [
                UserFlag::class,
                'name'       => 'flaggable',
                'conditions' => 'type = "like"'
            ];
        });
    }

    public static function addPlaysRelationToCatchphrase()
    {
        Catchphrase::extend(function (Catchphrase $catchphrase) {
            $catchphrase->morphMany['plays'] = [
                UserFlag::class,
                'name'       => 'flaggable',
                'conditions' => 'type = "play"'
            ];
        });
    }

    public static function addBookmarksRelationToCatchphrase()
    {
        Catchphrase::extend(function (Catchphrase $catchphrase) {
            $catchphrase->morphMany['bookmarks'] = [
                UserFlag::class,
                'name'       => 'flaggable',
                'conditions' => 'type = "bookmark"'
            ];
        });
    }

    public static function addSharesRelationToCatchphrase()
    {
        Catchphrase::extend(function (Catchphrase $catchphrase) {
            $catchphrase->morphMany['shares'] = [
                UserFlag::class,
                'name'       => 'flaggable',
                'conditions' => 'type = "share"'
            ];
        });
    }

    public static function addCommentsRelationToCatchphrase()
    {
        Catchphrase::extend(function (Catchphrase $catchphrase) {
            $catchphrase->morphMany['comments'] = [
                UserFlag::class,
                'name'       => 'flaggable',
                'conditions' => 'type = "comment"'
            ];
        });
    }

    public static function beforeDelete_deletePlaysLikesBookmarksSharesComments()
    {
        Catchphrase::extend(function (Catchphrase $catchphrase) {
            $catchphrase->bindEvent('model.beforeDelete', function () use ($catchphrase) {
                $catchphrase->plays()->delete();
                $catchphrase->likes()->delete();
                $catchphrase->bookmarks()->delete();
                $catchphrase->shares()->delete();
                $catchphrase->comments()->delete();
            });
        });
    }

    public static function afterRestore_restorePlaysLikesBookmarksSharesComments()
    {
        Catchphrase::extend(function (Catchphrase $catchphrase) {
            $catchphrase->bindEvent('model.afterRestore', function () use ($catchphrase) {
                $catchphrase->plays()->restore();
                $catchphrase->likes()->restore();
                $catchphrase->bookmarks()->restore();
                $catchphrase->shares()->restore();
                $catchphrase->comments()->restore();
            });
        });
    }

    public static function updateResource_addPlaysLikesBookmarksSharesCommentsCount()
    {
        Event::listen('apptupir.catchphrase.catchphrase.beforeReturnResource', function(&$response, Catchphrase $catchphrase) {
            $response['likes'] = UserFlag::where([
                'flaggable_id'   => $catchphrase->id,
                'flaggable_type' => Catchphrase::class,
                'type'          => 'like',
                'value'         => 1
            ])->count();

            $response['bookmarks'] = UserFlag::where([
                'flaggable_id'   => $catchphrase->id,
                'flaggable_type' => Catchphrase::class,
                'type'          => 'bookmark',
                'value'         => 1
            ])->count();

            $response['shares'] = UserFlag::where([
                'flaggable_id'   => $catchphrase->id,
                'flaggable_type' => Catchphrase::class,
                'type'          => 'share'
            ])->count();

            $response['comments'] = UserFlag::where([
                'flaggable_id'   => $catchphrase->id,
                'flaggable_type' => Catchphrase::class,
                'type'          => 'comment'
            ])->count();

            $response['plays'] = UserFlag::where([
                'flaggable_id'   => $catchphrase->id,
                'flaggable_type' => Catchphrase::class,
                'type'          => 'play'
            ])->count();
        });
    }
}
