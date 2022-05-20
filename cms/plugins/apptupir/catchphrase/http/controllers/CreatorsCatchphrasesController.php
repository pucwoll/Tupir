<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class CreatorsCatchphrasesController extends Controller
{
    public function show($id)
    {
        $user = User::isCreator()
            ->findOrFail($id);

        $catchphrases = $user->catchphrases;

        return CatchphraseResource::collection($catchphrases);
    }
}
