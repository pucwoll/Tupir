<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use LibUser\UserApi\Http\Middlewares\Check;
use LibUser\UserApi\Http\Middlewares\Authenticate;
use LibUser\Device\Http\Controllers\DeviceApiController;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;

Route::group([
    'prefix' => 'api/v1/auth/devices',
    'middleware' => [
        ApiExceptionMiddleware::class,
        'api',
        Check::class,
        Authenticate::class
    ]
], function (Router $router) {

    $router
        ->post('register', [DeviceApiController::class, 'register']);

    $router
        ->group(['prefix' => '{token}'], function (Router $router) {
        $router
            ->put('', [DeviceApiController::class, 'update']);
        $router
            ->delete('', [DeviceApiController::class, 'delete']);
    });
});
