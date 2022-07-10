<?php namespace LibUser\UserApi;

use System\Classes\PluginBase;
use LibUser\UserApi\Providers\AuthServiceProvider;
use LibUser\UserApi\Providers\JWTAuthServiceProvider;

class Plugin extends PluginBase
{
    public $elevated = true;
    
    public $require = [
        'RainLab.User',
    ];
    
    public function pluginDetails()
    {
        return [
            'name'        => 'UserApi',
            'description' => 'Implement auth API for RainLab.User plugin',
            'author'      => 'Wezeo',
            'icon'        => 'icon-key',
        ];
    }
    
    public function register()
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(JWTAuthServiceProvider::class);
    }
}
