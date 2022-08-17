<?php namespace AppTupir\Catchphrase\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LibUser\UserApi\Facades\JWTAuth;
use October\Rain\Support\Facades\Event;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class CatchphrasesController extends Controller
{
    public function index()
    {
        return CatchphraseResource::collection(
            Catchphrase::isPublished()
                ->whereHas('user', function ($query) {
                    return $query->isPublished();
                })
                ->inRandomOrder()
                ->get()
        );
    }

    public function show($key)
    {
        $catchphrase = Catchphrase::isPublished()
            ->where('id', $key)
            ->orWhere('uuid', $key)
            ->orWhere('slug', $key)
            ->whereHas('user', function ($query) {
                return $query->isPublished();
            })
            ->firstOrFail();

        Event::fire('apptupir.catchphrase.action.show', [$catchphrase]);

        return new CatchphraseResource($catchphrase);
    }

    public function store()
    {
        $catchphrase = new Catchphrase();

        $catchphrase->fill(post());

        $catchphrase->user = JWTAuth::getUser();

        $catchphrase->save();

        return new CatchphraseResource($catchphrase);
    }

    public function update(Request $request, Catchphrase $catchphrase)
    {
        $user = JWTAuth::getUser();

        $catchphrase->fill($request->all());
        $catchphrase->user = $user;

        $catchphrase->save();

        return new CatchphraseResource($catchphrase);
    }

    public function destroy(Catchphrase $catchphrase)
    {
        $catchphrase->delete();

        return new CatchphraseResource($catchphrase);
    }
}
