<?php namespace AppTupir\Catchphrase;

use Backend;
use System\Classes\PluginBase;
use Illuminate\Contracts\Http\Kernel;
use LibUser\UserApi\Http\Middlewares\Check;
use AppTupir\Catchphrase\Classes\Extend\UserExtend;

/**
 * Project Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'RainLab.User'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Catchphrase',
            'description' => 'No description provided yet...',
            'author'      => 'AppTupir',
            'icon'        => 'icon-commenting'
        ];
    }

    public function register()
    {
        $this->app[Kernel::class]->pushMiddleware(Check::class);
    }

    public function boot()
    {
        UserExtend::addCatchphraseRelationToUser();
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'catchphrase' => [
                'label' => 'Catchphrases',
                'url'   => Backend::url('apptupir/catchphrase/catchphrases'),
                'icon'  => 'icon-commenting',
                'order' => 500,
            ],
        ];
    }
}
