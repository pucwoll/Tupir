<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use October\Rain\Support\Facades\Input;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class UsersCatchphrasesController extends Controller
{
    public function show($key)
    {
        $sortType = Input::get('sort_type');

        $user = User::isPublished()
            ->where('username', $key)
            ->orWhere('id', $key)
            ->firstOrFail();

        $catchphrases = $user->catchphrases;

        if ($sortType === 'newest') {
            return CatchphraseResource::collection(
                $catchphrases->sortByDesc('created_at')
            );
        }
        else if ($sortType === 'most_liked') {
            return CatchphraseResource::collection(
                $catchphrases->sortByDesc('likes_count')
            );
        }
        else if ($sortType === 'most_discussed') {
            return CatchphraseResource::collection(
                $catchphrases->sortByDesc('comments_count')
            );
        }
        else if ($sortType === 'most_played') {
            return CatchphraseResource::collection(
                $catchphrases->sortByDesc('plays_count')
            );
        }

        return CatchphraseResource::collection(
            $catchphrases->sortByDesc('created_at')
        );
    }
}
