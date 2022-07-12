<?php

use Illuminate\Routing\Router;
use LibUser\UserApi\Http\Middlewares\Check as AuthCheck;
use LibUser\UserFlag\Http\Middlewares\Bindings\UserBind;
use LibUser\UserApi\Http\Middlewares\Authenticate as Auth;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;

Route::group([
    'prefix'     => 'api/v1',
    'namespace'  => 'LibUser\UserFlag\Http\Controllers',
    'middleware' => [
        ApiExceptionMiddleware::class,
        AuthCheck::class,
        UserBind::class,
    ],
], function(Router $router) {
    $router
        ->post('userflag/{model}/{id}', 'UserFlagController@storeOrUpdate');

    $router
        ->middleware(Auth::class)
        ->group(function(Router $router) {
            $router
                ->get('userflag/flags/{model}/{id}', 'UserFlagController@getFlags_modelAndId');
            $router
                ->get('userflag/flags/{model}', 'UserFlagController@getFlags_model');
            $router
                ->get('userflag/models/{model}/{type}', 'UserFlagController@getModels_modelAndType');
            $router
                ->get('userflag/models/{type}', 'UserFlagController@getModels_type');
        });
});
