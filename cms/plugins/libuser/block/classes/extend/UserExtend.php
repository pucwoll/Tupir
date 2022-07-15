<?php namespace LibUser\Block\Classes\Extend;

use RainLab\User\Models\User;
use October\Rain\Database\Builder;
use LibUser\UserApi\Facades\JWTAuth;
use Illuminate\Support\Facades\Event;

class UserExtend
{
    public static function addScopeCanSee()
    {
        User::extend(function (User $model) {
            $model->addDynamicMethod('scopeCanSee', function (Builder $query) {
                $user = JWTAuth::getUser();

                Event::fire('libuser.block.scopeCanSee', [$query]);

                if (!$user) {
                    return;
                }

                $blockedUsersIds = $user->blockedUsers()->get()->pluck('id');

                return $query->whereNotIn('id', $blockedUsersIds);
            });
        });
    }

    public static function addBlockedUserRelation() {
        User::extend(function (User $model) {
            $model->belongsToMany['blockedUsers'] = [
                User::class,
                'table' => 'libuser_block_user_blocks',
                'pivot' => ['deleted_at'],
                'conditions' => 'libuser_block_user_blocks.deleted_at IS NULL',
                'key' => 'user_id',
                'otherKey' => 'blocked_user_id',
            ];
        });
    }

    public static function beforeReturnUser() {
        Event::listen('libuser.profile.profile.beforeReturnResource', function (&$response, $resource) {
            $user = JWTAuth::getUser();

            if (!$user) {
                return;
            }

            $response['is_blocked_by_active_user'] = $user->blockedUsers()->where('users.id', $resource->id)->exists();
        });
    }
}
