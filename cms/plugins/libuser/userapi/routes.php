<?php

Route::group([
    'prefix'     => config('libuser.userapi::routes.prefix'),
    'middleware' => config('libuser.userapi::routes.middlewares', []),
], function() {
    $actions = config('libuser.userapi::routes.actions', []);
    foreach ($actions as $action) {
        $methods = $action['method'];
        if (!is_array($methods)) {
            $methods = [$methods];
        }

        foreach ($methods as $method) {
            Route::{$method}($action['route'], $action['controller'])->middleware($action['middlewares']);
        }
    }
});
