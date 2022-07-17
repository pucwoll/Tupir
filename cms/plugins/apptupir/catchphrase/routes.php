<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

use LibUser\UserApi\Http\Middlewares\Check;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;
use AppTupir\Catchphrase\Http\Middlewares\CatchphrasePolicy;

use AppTupir\Catchphrase\Http\Controllers\CatchphrasesController;

use AppTupir\Catchphrase\Http\Controllers\UsersController;
use AppTupir\Catchphrase\Http\Controllers\UsersCatchphrasesController;

use AppTupir\Catchphrase\Http\Controllers\SearchController;

use AppTupir\Catchphrase\Http\Controllers\DiscoversController;

Route::group([
    'prefix'      => 'api/v1',
    'middleware' => [
        ApiExceptionMiddleware::class,
        'api',
        Check::class
    ]
], function (Router $router) {
    $router
        ->resource('catchphrases', CatchphrasesController::class)->only(['index', 'store']);
    $router
        ->apiResource('catchphrases', CatchphrasesController::class)
        ->middleware(CatchphrasePolicy::class)
        ->only(['update', 'destroy']);
    $router
        ->get('catchphrases/{key}', [CatchphrasesController::class, 'show']);

    $router
        ->get('users', [UsersController::class, 'index']);
    $router
        ->get('users/{key}', [UsersController::class, 'show']);
    $router
        ->get('users/{key}/catchphrases', UsersCatchphrasesController::class);

    $router
        ->get('search', SearchController::class);

    $router
        ->get('discovers', DiscoversController::class);
});
