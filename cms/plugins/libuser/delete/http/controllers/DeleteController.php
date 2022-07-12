<?php namespace LibUser\Delete\Http\Controllers;

use RainLab\User\Facades\Auth;
use Illuminate\Routing\Controller;
use LibUser\UserApi\Facades\JWTAuth;
use Illuminate\Support\Facades\Event;

class DeleteController extends Controller
{
    public function handle()
    {
        $user = JWTAuth::getUser();

        Auth::authenticate([
            'login'    => $user->email,
            'password' => input('password'),
        ]);

        Event::fire('libuser.delete.beforeDelete', [$user]);

        $user->forceDelete();
    }
}
