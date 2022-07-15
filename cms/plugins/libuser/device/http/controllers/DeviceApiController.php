<?php namespace LibUser\Device\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;

class DeviceApiController extends Controller
{
    public function register()
    {
        $user = auth()->user();
        $user->devices()->create([
            'raw_data' => Request::post(),
        ]);
    }

    public function update($token)
    {
        $user = auth()->user();
        $user->devices()
            ->whereToken($token)
            ->update([
                'raw_data' => Request::post(),
            ]);
    }

    public function delete($token)
    {
        $user = auth()->user();
        $user->devices()
            ->whereToken($token)
            ->delete();
    }
}
