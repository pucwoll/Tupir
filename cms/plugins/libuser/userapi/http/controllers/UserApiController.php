<?php namespace LibUser\UserApi\Http\Controllers;

use Illuminate\Routing\Controller;
use LibUser\UserApi\Classes\ApiError;
use Illuminate\Support\Facades\Request;
use LibUser\UserApi\Classes\UserApiHook;

abstract class UserApiController extends Controller
{
    abstract public function handle();
    
    public function __invoke(Request $request)
    {
        try {
            return UserApiHook::hook('beforeProcess', [$this], function() {
                return $this->handle();
            });
        } catch (\Exception $exception) {
            return UserApiHook::hook('beforeReturnException', [$this, $exception], function() use ($exception) {
                return ApiError::response($exception);
            });
        }
    }
}
