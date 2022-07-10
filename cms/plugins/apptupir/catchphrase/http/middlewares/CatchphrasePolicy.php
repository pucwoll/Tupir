<?php namespace AppTupir\Catchphrase\Http\Middlewares;

use Closure;
use LibUser\UserApi\Facades\JWTAuth;
use October\Rain\Exception\ApplicationException;

class CatchphrasePolicy
{
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::getUser();
        $catchphrase = $request->route()->parameter('catchphrase');

        if ($catchphrase->user->id !== $user->id) {
            throw new ApplicationException('You are not authorized to access this Catchphrase.');
        }

        return $next($request);
    }
}
