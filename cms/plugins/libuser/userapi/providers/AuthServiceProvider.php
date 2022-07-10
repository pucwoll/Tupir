<?php namespace LibUser\UserApi\Providers;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Guard;
use October\Rain\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('auth', function($app) {
            $app['auth.loaded'] = true;

            return new AuthManager($app);
        });

        $this->app->singleton('auth.driver', function($app) {
            return $app['auth']->guard();
        });

        $this->app->singleton('user.auth', function() {
            return \LibUser\UserApi\Classes\AuthManager::instance();
        });
    }

    public function boot()
    {
        $this->app->bind(AuthManager::class, 'auth');
        $this->app->bind(Guard::class, 'auth.driver');

        $this->mergeConfigFrom(plugins_path('libuser/userapi/config/auth.php'), 'auth');
    }
}
