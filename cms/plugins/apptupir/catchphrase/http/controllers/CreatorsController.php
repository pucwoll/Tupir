<?php namespace AppTupir\Catchphrase\Http\Controllers;

use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use Libuser\Userapi\Http\Resources\SimpleUserResource;

class CreatorsController extends Controller
{
    public function index()
    {
        return SimpleUserResource::collection(
            User::isCreator()
                ->orderBy('created_at', 'desc')
                ->paginate(User::isCreator()->count())
        );
    }

    public function show($id)
    {
        $creator = User::isCreator()
            ->findOrFail($id);

        return new SimpleUserResource($creator);
    }
}
