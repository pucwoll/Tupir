<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use October\Rain\Support\Facades\Input;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\User\Http\Resources\SimpleUserResource;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class SearchController extends Controller
{
    public function show()
    {
        $search = Input::get('q');

        $user = SimpleUserResource::collection(
            User::isPublished()
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->get()
        );

        $catchphrase = CatchphraseResource::collection(
            Catchphrase::isPublished()
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%')
                ->orWhere('lyrics', 'like', '%' . $search . '%')
                ->whereHas('user', function ($query) {
                    return $query->isPublished();
                })
                ->get()
        );

        if (count($user) || count($catchphrase)) {
            return response()->json([
                'data' => $user->concat($catchphrase)
            ]);
        }
        else {
            return response()->json([
                'error'      => 'No users or catchphrases found',
                'statusCode' => 404
            ], 404);
        }
    }
}
