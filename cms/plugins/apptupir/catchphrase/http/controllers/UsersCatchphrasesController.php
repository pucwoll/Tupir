<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use October\Rain\Support\Facades\Input;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class UsersCatchphrasesController extends Controller
{
    public function __invoke($key)
    {
        $sortType = Input::get('sort_type');

        $user = User::isPublished()
            ->where('username', $key)
            ->orWhere('id', $key)
            ->value('id');

        if ($sortType === 'newest') {
            return CatchphraseResource::collection(
                Catchphrase::isPublished()
                    ->where('user_id', $user)
                    ->orderByDesc('created_at')
                    ->get()
            );
        }
        else if ($sortType === 'most_liked') {
            return CatchphraseResource::collection(
                Catchphrase::isPublished()
                    ->where('user_id', $user)
                    ->withCount('likes')
                    ->orderByDesc('likes_count')
                    ->orderByDesc('created_at')
                    ->get()
            );
        }
        else if ($sortType === 'most_discussed') {
            return CatchphraseResource::collection(
                Catchphrase::isPublished()
                    ->where('user_id', $user)
                    ->select([
                    'apptupir_catchphrases.*',
                    DB::raw('(SELECT count(*)
                    FROM libchat_comments_comments
                    WHERE libchat_comments_comments.commentable_id = apptupir_catchphrases.id
                    ) as comments_count')
                ])
                    ->from('apptupir_catchphrases')
                    ->orderByDesc('comments_count')
                    ->orderByDesc('created_at')
                    ->get()
            );
        }
        else if ($sortType === 'most_played') {
            return CatchphraseResource::collection(
                Catchphrase::isPublished()
                    ->where('user_id', $user)
                    ->withCount('plays')
                    ->orderByDesc('plays_count')
                    ->orderByDesc('created_at')
                    ->get()
            );
        }

        return CatchphraseResource::collection(
            Catchphrase::isPublished()
                ->where('user_id', $user)
                ->orderByDesc('created_at')
                ->get()
        );
    }
}
