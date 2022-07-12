<?php namespace AppTupir\Comment;

use Backend;
use System\Classes\PluginBase;
use AppTupir\Comment\Classes\Extend\CommentExtend;

/**
 * Comment Plugin Information File
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
            'name'        => 'Comment',
            'description' => 'No description provided yet...',
            'author'      => 'AppTupir',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        CommentExtend::extendCommentResource();
    }
}
