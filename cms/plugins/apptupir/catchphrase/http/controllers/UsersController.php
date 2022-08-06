<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use AppTupir\User\Http\Resources\SimpleUserResource;

class UsersController extends Controller
{
    public function index()
    {
        return SimpleUserResource::collection(
            User::isPublished()
                ->inRandomOrder()
                ->get()
        );
    }

    public function show($key)
    {
        $user = User::isPublished()
            ->where('username', $key)
            ->orWhere('id', $key)
            ->firstOrFail();

        return new SimpleUserResource($user);
    }
}
