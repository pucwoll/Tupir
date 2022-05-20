<?php namespace LibUser\UserApi\Http\Controllers;

use System\Models\File;
use LibUser\UserApi\Facades\JWTAuth;
use Illuminate\Support\Facades\Event;
use LibUser\UserApi\Classes\UserApiHook;

class InfoUpdateApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $data = post();
        $user = JWTAuth::getUser();

        $user->fill($data);

        if (array_has($data, 'avatar') && empty($data['avatar']) && $user->avatar) {
            $user->avatar->delete();
            $user->avatar = null;
        }

        if (request()->hasFile('avatar')) {
            $file = new File();
            $file->fromPost(request()->file('avatar'));
            $file->save();

            $user->avatar = $file;
        }

        $user->save();

        Event::fire('libuser.userapi.beforeReturnUser', [$user]);

        $userResourceClass = config('libuser.userapi::resources.user');
        $response = [
            'user' => new $userResourceClass($user),
        ];

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function() use ($response) {
            return response()->make([
                'data'   => $response,
                'status' => 200,
            ], 200);
        });
    }
}
