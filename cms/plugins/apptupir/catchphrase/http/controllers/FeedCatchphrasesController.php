<?php namespace AppTupir\Catchphrase\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LibUser\UserApi\Facades\JWTAuth;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\Catchphrase\Classes\Services\RecommendService;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class FeedCatchphrasesController extends Controller
{
    public function recommended(Request $request)
    {
        $user = JWTAuth::getUser();

        return RecommendService::getCatchphraseFeedForUser($user);
    }

    public function following(Request $request)
    {
        $user = JWTAuth::getUser();

        $catchphrases = Catchphrase::isPublished()
            ->whereHas('user', function ($query) {
                return $query->isPublished()->canSee();
            })
            ->whereIn('user_id', $user->following->pluck('flaggable_id')->toArray())
            ->userHasAccess()
            ->orderByDesc('created_at')
            ->get();

        return CatchphraseResource::collection($catchphrases);
    }
}
