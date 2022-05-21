<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;
use AppTupir\Catchphrase\Http\Controllers\SearchController;
use AppTupir\Catchphrase\Http\Controllers\CreatorsController;
use AppTupir\Catchphrase\Http\Controllers\CatchphrasesController;
use AppTupir\Catchphrase\Http\Controllers\CreatorsCatchphrasesController;

Route::group([
    'prefix'     => 'api/v1',
    'middleware' => [
        ApiExceptionMiddleware::class,
        'api',
    ]
], function (Router $router) {
    $router->get('catchphrases', [CatchphrasesController::class, 'index']);
    $router->get('catchphrases/{id}', [CatchphrasesController::class, 'show']);

    $router->get('creators', [CreatorsController::class, 'index']);
    $router->get('creators/{id}', [CreatorsController::class, 'show']);

    $router->get('creators/{id}/catchphrases', [CreatorsCatchphrasesController::class, 'show']);

    $router->get('search/{search}', [SearchController::class, 'show']);
});
