<?php namespace LibUser\UserApi\Http\Controllers;

use LibUser\UserApi\Facades\JWTAuth;
use Illuminate\Support\Facades\Event;
use LibUser\UserApi\Classes\UserApiHook;

class InfoApiController extends UserApiController
{
    public function handle()
    {
        $response = [];
        
        $user = JWTAuth::getUser();
        
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
