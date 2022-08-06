<?php namespace WIntegration\FireBasePush;

use App;
use Config;
use Backend;
use System\Classes\PluginBase;
use Plokko\Firebase\ServiceAccount;
use Illuminate\Foundation\AliasLoader;
use Plokko\LaravelFirebase\FcmMessageBuilder;

/**
 * FireBasePush Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'FireBasePush',
            'description' => 'No description provided yet...',
            'author' => 'WIntegration',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $this->bootPackages();

        $this->app->bind(FcmMessageBuilder::class, function ($app) {
            $fcm = new \WIntegration\FirebasePush\Classes\FcmMessageBuilder($app->make(ServiceAccount::class));

            $event = config('laravel-firebase.FCMInvalidTokenTriggerEvent');
            if ($event) {
                $fcm->setInvalidTokenEvent($event);
            }

            return $fcm;
        });
    }

    public function bootPackages()
    {
        $pluginNamespace = str_replace('\\', '.', strtolower(__NAMESPACE__));
        $aliasLoader = AliasLoader::getInstance();
        $packages = Config::get($pluginNamespace.'::packages');

        foreach ($packages as $name => $options) {
            if (!empty($options['config']) && !empty($options['config_namespace'])) {
                Config::set($options['config_namespace'], $options['config']);
            }

            if (!empty($options['providers'])) {
                foreach ($options['providers'] as $provider) {
                    App::register($provider);
                }
            }

            if (!empty($options['aliases'])) {
                foreach ($options['aliases'] as $alias => $path) {
                    $aliasLoader->alias($alias, $path);
                }
            }
        }
    }

    public function registerNavigation()
    {
        return [
            'firebasepush' => [
                'label'       => 'Push notifications',
                'url'         => \Backend\Facades\Backend::url('wintegration/firebasepush/notifications'),
                'icon'        => 'icon-comments',
            ],
        ];
    }
}
