<?php namespace LibUser\UserApi\Providers;

use LibUser\UserApi\Classes\JWTAuth;
use Tymon\JWTAuth\Providers\AbstractServiceProvider;

class JWTAuthServiceProvider extends AbstractServiceProvider
{
    /**
     * @inheritDoc
     */
    public function boot()
    {
        $this->aliasMiddleware();

        $this->app->alias('JWTAuth', 'LibUser\UserApi\Facades\JWTAuth');
        $this->app->alias('JWTFactory', 'Tymon\JWTAuth\Facades\JWTFactory');
    }

    /**
     * @inheritDoc
     */
    protected function config($key, $default = null)
    {
        return config("libuser.userapi::$key",
            config("jwt.$key", $default)
        );
    }

    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware()
    {
        $router = $this->app['router'];

        $method = method_exists($router, 'aliasMiddleware') ? 'aliasMiddleware' : 'middleware';

        foreach ($this->middlewareAliases as $alias => $middleware) {
            $router->$method($alias, $middleware);
        }
    }

    /**
     * Register the bindings for the main JWTAuth class.
     *
     * @return void
     */
    protected function registerJWTAuth()
    {
        $this->app->singleton('tymon.jwt.auth', function($app) {
            return (new JWTAuth(
                $app['tymon.jwt.manager'],
                $app['tymon.jwt.provider.auth'],
                $app['tymon.jwt.parser']
            ))->lockSubject($this->config('lock_subject'));
        });
    }
}
