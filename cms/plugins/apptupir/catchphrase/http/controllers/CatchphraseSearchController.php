<?php namespace AppTupir\Catchphrase\Http\Controllers;

use Illuminate\Routing\Controller;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class CatchphraseSearchController extends Controller
{
    public function show($search)
    {
        $result = CatchphraseResource::collection(
            Catchphrase::isPublished()
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('lyrics', 'like', '%' . $search . '%')
                ->get()
        );
        if (count($result)) {
            return $result;
        }
        else {
            return response()->json(['error' => 'No catchphrases found'], 404);
        }
    }
}
