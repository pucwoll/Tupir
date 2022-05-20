<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use Libuser\Userapi\Http\Resources\SimpleUserResource;

class CreatorSearchController extends Controller
{
    public function show($search)
    {
        $result = SimpleUserResource::collection(
            User::isCreator()
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('surname', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->get()
        );
        if (count($result)) {
            return $result;
        }
        else {
            return response()->json(['error' => 'No creators found'], 404);
        }
    }
}
