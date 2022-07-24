<?php namespace AppTupir\Catchphrase\Classes\Services;

use RainLab\User\Models\User;
use LibChat\Comments\Models\Comment;
use LibUser\UserFlag\Models\UserFlag;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class RecommendService
{
    protected static $userScoreCache = [];

    public static function getCatchphraseFeedForUser($loggedUser)
    {
        if (!$loggedUser) {
            $catchphrases = Catchphrase::isPublished()
                ->inRandomOrder()
                ->take(5)
                ->get();

            return CatchphraseResource::collection($catchphrases);
        }

        $catchphrases = Catchphrase::isPublished()
            ->userHasAccess()
            ->withCount(['plays' => function ($query) use ($loggedUser) {
                $query->where('user_id', $loggedUser->id)->limit(3);
            }])
            ->orderBy('plays_count', 'asc')
            ->inRandomOrder()
            ->take(15)
            ->get()
            ->shuffle();

        $sortedCatchphrases = $catchphrases->sortBy(function ($catchphrase) use ($loggedUser) {
            return self::getCatchphraseScore_forUser($catchphrase, $loggedUser);
        })
            ->reverse()
            ->take(5);

        return CatchphraseResource::collection($sortedCatchphrases);
    }

    protected static function getCatchphraseScore_forUser($catchphrase, $loggedUser)
    {
        $authorScore = self::$userScoreCache[$catchphrase->user->id] ?? 0;

        if (!isset(self::$userScoreCache[$catchphrase->user->id])) {
            $isFollowed = $loggedUser
                ->likes()
                ->where('user_id', $catchphrase->user->id)
                ->exists();

            $likedCatchphrasesCount = UserFlag::where([
                'user_id' => $loggedUser->id,
                'type'    =>  'like',
                'value'   =>  1
            ])
                ->whereHasMorph('flaggable', [Catchphrase::class], function ($query) use ($catchphrase) {
                    $query->where('user_id', $catchphrase->user->id);
                })
                ->count();

            $authorScore
                = ($isFollowed             * config('apptupir.catchphrase::author.isFollowedWeight'))
                + ($likedCatchphrasesCount * config('apptupir.catchphrase::author.likedCountWeight'));

            self::$userScoreCache[$catchphrase->user->id] = $authorScore;
        }

        $plays = $catchphrase
            ->plays()
            ->where('user_id', $loggedUser->id)
            ->count();

        $isSaved = $loggedUser
            ->bookmarks()
            ->where('flaggable_id', $catchphrase->id)
            ->exists();

        $isLiked = $catchphrase
            ->likes()
            ->where('user_id', $loggedUser->id)
            ->exists();

        $isShared = $catchphrase
            ->shares()
            ->where('user_id', $loggedUser->id)
            ->exists();

        $isCommented = Comment::where('creatable_id', $loggedUser->id)
            ->where('creatable_type', User::class)
            ->where('commentable_id', $catchphrase->id)
            ->exists();

        $catchphraseScore
            = ($plays       * config('apptupir.catchphrase::catchphrase.playCountWeight'))
            + ($authorScore * config('apptupir.catchphrase::catchphrase.authorScoreWeight'))
            + ($isSaved     * config('apptupir.catchphrase::catchphrase.isSavedWeight'))
            + ($isCommented * config('apptupir.catchphrase::catchphrase.isCommentedWeight'))
            + ($isLiked     * config('apptupir.catchphrase::catchphrase.isLikedWeight'))
            + ($isShared    * config('apptupir.catchphrase::catchphrase.isSharedWeight'));

        return $catchphraseScore;
    }
}
