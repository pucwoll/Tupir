<?php namespace LibUser\Block\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use LibUser\UserApi\Facades\JWTAuth;
use LibUser\UserFlag\Models\UserFlag;
use October\Rain\Exception\ApplicationException;

class UserBlocksController extends Controller
{
    public function block($blockedUserId)
    {
        $user = JWTAuth::getUser();
        $blockedUser = User::findOrFail($blockedUserId);

        if ($user->is($blockedUser)) {
            throw new ApplicationException('You cannot block yourself', 400);
        }

        // Delete follows
        $follow = UserFlag::find(
            UserFlag::where([
                'flaggable_type' => User::class,
                'flaggable_id'   => $blockedUser->id,
                'user_id'       => $user->id,
                'type'          => 'follow'
            ])->value('id')
        );

        if ($follow) {
            $follow->value = false;
            $follow->save();
        }

        $user->blockedUsers()->syncWithoutDetaching($blockedUser);

        return [
            'success' => true
        ];
    }

    public function unblock($blockedUserId)
    {
        $user = JWTAuth::getUser();
        $blockedUser = User::findOrFail($blockedUserId);

        $user->blockedUsers()->detach($blockedUser);

        return [
            'success' => true
        ];
    }
}
