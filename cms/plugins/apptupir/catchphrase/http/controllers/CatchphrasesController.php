<?php namespace AppTupir\Catchphrase\Http\Controllers;

use Illuminate\Routing\Controller;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class CatchphrasesController extends Controller
{
    public function index()
    {
        return CatchphraseResource::collection(
            Catchphrase::isPublished()
                ->orderBy('created_at', 'desc')
                ->paginate(20)
        );
    }

    public function show($id)
    {
        $catchphrase = Catchphrase::isPublished()
            ->findOrFail($id);

        return new CatchphraseResource($catchphrase);
    }
}
