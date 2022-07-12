<?php namespace LibChat\Comments\Http\Middlewares\Policies;

use Closure;
use October\Rain\Exception\ApplicationException;

class CommentPolicy
{
    public function handle($request, Closure $next)
    {
        $routeGroup = explode('.', $request->route()->getName());
        $routeAction = $request->route()->getActionMethod();

        $user = $request->route()->parameter('user');

        switch ($routeGroup[0]) {
            case 'comments':
                $comment = $request->route()->parameter('comment');

                $allowedToPerformAction = false;

                switch ($routeAction) {
                    case 'update':
                        if (isset($user) && $comment->creatable->id == $user->id) {
                            $allowedToPerformAction = true;
                        }

                        if (!$allowedToPerformAction) {
                            throw new ApplicationException('You are not authorized to access this Catchphrase.');
                        }
                        break;
                    case 'destroy':
                        if (isset($user) && (!$user->groups->where('is_superuser', '=', '1')->isEmpty() || $comment->creatable->id == $user->id)) {
                            $allowedToPerformAction = true;
                        }

                        if (!$allowedToPerformAction) {
                            throw new ApplicationException('You are not authorized to access this Catchphrase.');
                        }
                        break;
                }
                break;

            default:
                return $next($request);
                break;
        }

        return $next($request);
    }
}
