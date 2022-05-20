# User API

## Description
Implement auth API for RainLab.User plugin

## Installation
1. Copy files to `plugins/libuser/userapi` directory
    - Via git submodules
        ```bash
        git submodule add https://gitlab.com/wezeo/ocms-plugins/userapi plugins/w/userapi
        ```
    - Via git clone
        ```bash
        git clone https://gitlab.com/wezeo/ocms-plugins/userapi plugins/w/userapi
        ```
2. Update composer dependencies
    ```bash
    composer update tymon/jwt-auth --with-dependencies
    ```
3. Generate JWT secret key
    ```bash
    php artisan jwt:secret 
    ```
4. Set env variables
5. Allow authorization header in your `.htaccess`
    ```apacheconfig
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
    ```
6. Setup Insomnia collection from `Insomnia.json` file (contains all endpoints with data)

## ENV variables
- `JWT_SECRET`
    - Secret key will be used for Symmetric algorithms only (HMAC)
    - default: config('app.key')
- `JWT_TTL`
    - Time (in minutes) that the token will be valid for
    - default: 60 (1 hour)
- `JWT_REFRESH_TTL`
    - Time (in minutes) that the token can be refreshed
    - default: 20160 (2 weeks)

## Events
- Before process the controller action
    ```php
    Event::listen('libuser.userapi.beforeProcess', function ($controller) {
      
        if (!$controller instanceof SignupApiController) {
            return;
        }
          
        return response()->make([
            'success' => true
        ], 201);
    });
    ```
- After process the controller action
    ```php
    Event::listen('libuser.userapi.afterProcess', function ($controller, $data) {
    
        if (!$controller instanceof SignupApiController) {
            return;
        }
    
        return response()->make($data, 201);
    });
    ```
- Before return user in the response
    ```php
    Event::listen('libuser.userapi.beforeReturnUser', function ($user) {
        $user->additional = 'userapi';
    });
    ```
- Send activation code after user sign up
    ```php
        Event::listen('libuser.userapi.sendActivationCode', function ($user, $code) {
            return Mail::send(...);
        });
    ```
- Send reset password code after user sign up
    ```php
        Event::listen('libuser.userapi.sendResetPasswordCode', function ($user, $code) {
            return Mail::send(...);
        });
    ```
- Create statistics after user logged out
    ```php
        Event::listen('libuser.userapi.afterInvalidate', function ($user) {
            return Statistic::create(..);
        });
    ```
