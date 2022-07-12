<?php namespace LibChat\Comments\Http\Middlewares\Bindings;

use Closure;
use LibUser\UserApi\Facades\JWTAuth;

class UserBind
{
    public function handle($request, Closure $next)
    {
        $request->route()->setParameter('user', JWTAuth::getUser());
        
        return $next($request);
    }
}