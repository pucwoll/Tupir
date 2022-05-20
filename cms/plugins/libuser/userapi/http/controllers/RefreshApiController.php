<?php namespace LibUser\UserApi\Http\Controllers;

use LibUser\UserApi\Facades\JWTAuth;
use Illuminate\Support\Facades\Event;
use LibUser\UserApi\Classes\UserApiHook;
use Tymon\JWTAuth\Exceptions\JWTException;

class RefreshApiController extends UserApiController
{
    public function handle()
    {
        $response = [];
        
        if (!$newToken = JWTAuth::parseToken()->refresh()) {
            throw new JWTException();
        }
        
        $user = JWTAuth::setToken($newToken)->authenticate();
        
        Event::fire('libuser.userapi.beforeReturnUser', [$user]);
        
        $userResourceClass = config('libuser.userapi::resources.user');
        $response = [
            'success' => true,
            'token'   => $newToken,
            'user'    => new $userResourceClass($user),
        ];
        
        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function() use ($response) {
            return response()->make([
                'data'   => $response,
                'status' => 200,
            ], 200);
        });
    }
}
