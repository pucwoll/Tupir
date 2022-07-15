<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use LibUser\UserApi\Http\Middlewares\Check;
use LibUser\UserApi\Http\Middlewares\Authenticate;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;

Route::group([
    'prefix' => 'api/v1/auth',
    'namespace' => 'LibUser\Report\Http\Controllers',
    'middleware' => [
        ApiExceptionMiddleware::class,
        'api',
        Check::class,
        Authenticate::class,
    ]
], function (Router $router) {

    $router
        ->post('reports', 'UserReportsController@store');
});
