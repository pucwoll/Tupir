<?php namespace LibUser\Block\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use LibUser\UserApi\Facades\JWTAuth;
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
        $user->following()->where('flaggable_type', User::class)->where('flaggable_id', $user->id)->delete();

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
