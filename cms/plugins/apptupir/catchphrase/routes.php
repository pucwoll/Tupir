<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

use LibUser\UserApi\Http\Middlewares\Check;
use LibUser\UserApi\Http\Middlewares\Authenticate;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;
use AppTupir\Catchphrase\Http\Middlewares\CatchphrasePolicy;

use AppTupir\Catchphrase\Http\Controllers\CatchphrasesController;

use AppTupir\Catchphrase\Http\Controllers\UsersController;
use AppTupir\Catchphrase\Http\Controllers\UsersCatchphrasesController;

use AppTupir\Catchphrase\Http\Controllers\FeedCatchphrasesController;

use AppTupir\Catchphrase\Http\Controllers\DiscoversController;

use AppTupir\Catchphrase\Http\Controllers\SearchController;

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
        ->get('catchphrases/feed/recommended', [FeedCatchphrasesController::class, 'recommended']);
    $router
        ->get('catchphrases/feed/following', [FeedCatchphrasesController::class, 'following'])
        ->middleware(Authenticate::class);

    $router
        ->get('discovers', DiscoversController::class);

    $router
        ->get('search', SearchController::class);
});
