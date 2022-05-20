<?php namespace LibUser\UserApi\Http\Controllers;

use LibUser\UserApi\Facades\JWTAuth;
use Illuminate\Support\Facades\Event;
use LibUser\UserApi\Classes\UserApiHook;

class InvalidateApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $user = JWTAuth::getUser();

        JWTAuth::invalidate(JWTAuth::parseToken()->getToken(), true);

        Event::fire('libuser.userapi.afterInvalidate', [$user]);

        $response = [
            'success' => true,
        ];

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function() use ($response) {
            return response()->make([
                'data'   => $response,
                'status' => 200,
            ], 200);
        });
    }
}
