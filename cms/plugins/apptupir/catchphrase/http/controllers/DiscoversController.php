<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use LibUser\UserFlag\Models\UserFlag;
use AppTupir\User\Http\Resources\SimpleUserResource;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class DiscoversController extends Controller
{
    public function index()
    {
        $users = UserFlag::whereHas('user')
            ->where([
                'flaggable_type' => 'RainLab\User\Models\User',
                'type'          => 'follow'
            ])
            ->whereHasMorph('flaggable', [User::class], function ($query) {
                $query->canSee();
            })
            ->select(['flaggable_type', 'flaggable_id'])
            ->groupBy(['flaggable_type', 'flaggable_id'])
            ->orderByRaw('sum(value) desc')
            ->orderByRaw('flaggable_id desc')
            ->get()
            ->pluck('flaggable');

        $catchphrases = UserFlag::whereHas('user')
            ->where([
                'flaggable_type' => 'AppTupir\Catchphrase\Models\Catchphrase',
                'type'          => 'like'
            ])
            ->select(['flaggable_type', 'flaggable_id'])
            ->groupBy(['flaggable_type', 'flaggable_id'])
            ->orderByRaw('sum(value) desc')
            ->orderByRaw('flaggable_id desc')
            ->get()
            ->pluck('flaggable');

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
