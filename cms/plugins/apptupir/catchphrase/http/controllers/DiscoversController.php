<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\User\Http\Resources\SimpleUserResource;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class DiscoversController extends Controller
{
    public function __invoke()
    {
        $users = User::isPublished()
            ->withCount('followers')
            ->orderByDesc('followers_count')
            ->orderByDesc('created_at')
            ->get();

        $catchphrases = Catchphrase::isPublished()
            ->whereHas('user', function ($query) {
                return $query->isPublished();
            })
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'data' => [
                'users' => SimpleUserResource::collection(
                    $users
                ),
                'catchphrases' => CatchphraseResource::collection(
                    $catchphrases
                )
            ]
        ]);
    }
}
