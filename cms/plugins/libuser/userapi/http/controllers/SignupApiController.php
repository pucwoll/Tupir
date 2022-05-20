<?php namespace LibUser\UserApi\Http\Controllers;

use RainLab\User\Facades\Auth;
use LibUser\UserApi\Facades\JWTAuth;
use Illuminate\Support\Facades\Event;
use LibUser\UserApi\Classes\UserApiHook;
use RainLab\User\Models\Settings as UserSettings;

class SignupApiController extends UserApiController
{
    public function handle()
    {
        $data = post();
        
        if (!array_key_exists('password_confirmation', $data)) {
            $data['password_confirmation'] = post('password');
        }
        
        $user = $this->registerUser($data);
        
        $token = null;
        if ($user->is_activated) {
            $token = JWTAuth::fromUser($user);
        }
        
        Event::fire('libuser.userapi.beforeReturnUser', [$user]);
        
        $userResourceClass = config('libuser.userapi::resources.user');
        $response = [
            'token' => $token,
            'user'  => new $userResourceClass($user),
        ];
        
        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function() use ($response) {
            return response()->make([
                'data'   => $response,
                'status' => 201,
            ], 201);
        });
    }
    
    protected function registerUser($data)
    {
        Event::fire('rainlab.user.beforeRegister', [&$data]);
        
        $automaticActivation = UserSettings::get('activate_mode') == UserSettings::ACTIVATE_AUTO;
        $userActivation = UserSettings::get('activate_mode') == UserSettings::ACTIVATE_USER;
        $user = Auth::register($data, $automaticActivation);
        
        Event::fire('rainlab.user.register', [$user, $data]);
        
        if ($userActivation && !$user->is_activated) {
            $this->sendActivationCode($user);
        }
        
        return $user;
    }
    
    protected function loginAttribute()
    {
        return UserSettings::get('login_attribute', UserSettings::LOGIN_EMAIL);
    }
    
    protected function sendActivationCode($user)
    {
        $activationCode = $user->activation_code ?? $user->getActivationCode();
        return Event::fire('libuser.userapi.sendActivationCode', [$user, $activationCode], true);
    }
}
