<?php

use Illuminate\Support\Facades\Route;
use LibUser\UserApi\Http\Middlewares\Authenticate;
use LibUser\Delete\Http\Controllers\DeleteController;

Route::group([
    'prefix' => 'api/v1/auth',
    'middleware' => Authenticate::class,
], function (Route $route) {
    $route
        ->delete('/delete', [DeleteController::class, 'handle']);
});
