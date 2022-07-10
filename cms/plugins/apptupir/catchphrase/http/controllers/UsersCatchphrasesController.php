<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class UsersCatchphrasesController extends Controller
{
    public function show($key)
    {
        $user = User::isPublished()
            ->where('username', $key)
            ->orWhere('id', $key)
            ->firstOrFail();

        $catchphrases = $user->catchphrases;

        return CatchphraseResource::collection($catchphrases);
    }
}
