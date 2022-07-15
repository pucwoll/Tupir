<?php

use Illuminate\Support\Facades\Route;
use LibUser\UserApi\Http\Middlewares\Check;
use LibUser\UserApi\Http\Middlewares\Authenticate;
use LibUser\Delete\Http\Controllers\DeleteController;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;

Route::group([
    'prefix' => 'api/v1/auth',
    'middleware' => [
        ApiExceptionMiddleware::class,
        'api',
        Check::class,
        Authenticate::class,
    ],
], function (Route $route) {
    $route
        ->delete('/delete', [DeleteController::class, 'handle']);
});
