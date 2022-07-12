<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use LibUser\UserApi\Http\Middlewares\Check as AuthCheck;
use LibChat\Comments\Http\Middlewares\Bindings\UserBind;
use LibUser\UserApi\Http\Middlewares\Authenticate as Auth;
use LibChat\Comments\Http\Middlewares\Bindings\ModelBind;
use LibChat\Comments\Http\Middlewares\Policies\CommentPolicy;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;

Route::group([
    'prefix'     => 'api/v1',
    'namespace'  => 'LibChat\Comments\Http\Controllers',
    'middleware' => [
        ApiExceptionMiddleware::class,
        AuthCheck::class,
        UserBind::class,
        ModelBind::class,
        CommentPolicy::class,
    ],
], function(Router $router) {

    $router
        ->get('comments/{node}/{id}', 'CommentsController@index')
        ->middleware(config('libchat.comments::unregistered_user_allowed_to_read') ? [] : [Auth::class])
        ->name('comments.index');

    $router
        ->post('comments/{node}/{id}', 'CommentsController@store')
        ->middleware([Auth::class,])
        ->name('comments.store');

    $router
        ->get('comments/{comment}', 'CommentsController@show')
        ->middleware(config('libchat.comments::unregistered_user_allowed_to_read') ? [] : [Auth::class])
        ->name('comments.show');

    $router
        ->delete('comments/{comment}', 'CommentsController@destroy')
        ->middleware([Auth::class,])
        ->name('comments.destroy');

    $router
        ->match(['put', 'patch',], 'comments/{comment}', 'CommentsController@update')
        ->middleware([Auth::class,])
        ->name('comments.update');

});

