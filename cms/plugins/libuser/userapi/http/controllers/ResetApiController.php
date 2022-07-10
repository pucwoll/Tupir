<?php namespace LibUser\UserApi\Http\Controllers;

use Carbon\Carbon;
use RainLab\User\Models\User;
use LibUser\UserApi\Classes\UserApiHook;
use Illuminate\Support\Facades\Validator;
use October\Rain\Exception\ValidationException;
use October\Rain\Exception\ApplicationException;

class ResetApiController extends UserApiController
{
    public function handle()
    {
        $response = [];
        
        $params = [
            'email'                 => input('email'),
            'code'                  => input('code'),
            'password'              => input('password'),
            'password_confirmation' => input('password_confirmation') ?? input('password'),
        ];
        
        $validation = Validator::make($params, [
            'email'    => 'required|email',
            'code'     => 'required',
            'password' => sprintf('required|between:%d,255|confirmed', User::getMinPasswordLength()),
        ]);
        
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }
        
        $user = User::where('email', $params['email'])->firstOrFail();
        
        $userResetPasswordCode = explode('!', $user->reset_password_code);
        
        if (Carbon::now()->diffInMinutes(Carbon::createFromTimestamp($userResetPasswordCode[0])) > 15) {
            throw new ApplicationException('Reset password code expired');
        }
        
        if (!$user->attemptResetPassword($userResetPasswordCode[0] . '!' . $params['code'], $params['password'])) {
            throw new ApplicationException('Reset password code is not valid');
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
