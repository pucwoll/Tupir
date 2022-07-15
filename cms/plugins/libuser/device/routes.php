<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use LibUser\Device\Http\Controllers\DeviceApiController;

Route::group([
    'prefix' => 'api/v1/auth/devices',
    'middleware' => [
        'api',
        'auth'
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
