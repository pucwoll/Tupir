<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\User\Http\Resources\SimpleUserResource;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class DiscoverController extends Controller
{
    public function discoverCatchphrases()
    {
        return CatchphraseResource::collection(
            Catchphrase::isPublished()
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->whereHas('user', function ($query) {
                    return $query->isPublished();
                })
                ->get()
        );
    }

    public function discoverUsers()
    {
        return SimpleUserResource::collection(
            User::isPublished()
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->get()
        );
    }
}
