<?php namespace LibUser\UserApi\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Support\Facades\Event;
use LibUser\UserApi\Classes\UserApiHook;
use October\Rain\Exception\ApplicationException;

class VerifyResendApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $params = [
            'email' => input('email'),
        ];

        $user = User::where('email', $params['email'])->firstOrFail();

        if ($user->is_activated) {
            throw new ApplicationException('User already activated');
        }

        $this->sendActivationCode($user);

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

    protected function sendActivationCode($user)
    {
        $activationCode = $user->activation_code ?? $user->getActivationCode();
        return Event::fire('libuser.userapi.sendActivationCode', [$user, $activationCode], true);
    }
}
