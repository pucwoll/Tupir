<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use LibUser\UserApi\Http\Middlewares\Check;
use LibUser\Profile\Http\Controllers\ProfilesController;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;

Route::group([
    'prefix'      => 'api/v1',
    'middleware' => [
        ApiExceptionMiddleware::class,
        'api',
        Check::class
    ]
], function (Router $router) {

    $router
        ->get('profile/{key}', ProfilesController::class)
        ->name('profile.show')
        ->name('profile.by_username');
});
