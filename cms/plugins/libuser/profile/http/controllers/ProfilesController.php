<?php namespace LibUser\Profile\Http\Controllers;

use Illuminate\Http\Request;
use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use LibUser\Profile\Http\Resources\ProfileResource;

class ProfilesController extends Controller
{
    public function __invoke(Request $request, $key)
    {
        $user = User::isPublished()
            ->where('id', $key)
            ->orWhere('uuid', $key)
            ->orWhere('username', $key)
            ->canSee()
            ->firstOrFail();

        return new ProfileResource($user);
    }
}
