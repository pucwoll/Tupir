<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class CreatorsCatchphrasesController extends Controller
{
    public function show($id)
    {
        $creator = User::isCreator()
            ->findOrFail($id);

        $catchphrases = $creator->catchphrases;

        return CatchphraseResource::collection($catchphrases);
    }
}
