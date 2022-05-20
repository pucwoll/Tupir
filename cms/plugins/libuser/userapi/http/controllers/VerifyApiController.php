<?php namespace LibUser\UserApi\Http\Controllers;

use RainLab\User\Models\User;
use LibUser\UserApi\Classes\UserApiHook;
use October\Rain\Exception\ApplicationException;

class VerifyApiController extends UserApiController
{
    public function handle()
    {
        $response = [];
        
        $params = [
            'email' => input('email'),
            'code'  => input('code'),
        ];
        
        $user = User::where('email', $params['email'])->firstOrFail();
        
        if (!$user->attemptActivation($params['code'])) {
            throw new ApplicationException('Activation code is not valid');
        }
        
        $response = [
            'success' => true,
        ];
        
        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function() use ($response) {
            return response()->make([
                'data'   => $response,
                'status' => 200,
            ], 200);
        });
    }
}
