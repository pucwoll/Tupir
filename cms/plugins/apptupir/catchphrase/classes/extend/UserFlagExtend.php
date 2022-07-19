<?php namespace AppTupir\Catchphrase\Classes\Extend;

use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class UserFlagExtend
{
    public static function addPostToAliasesConfig()
    {
        config([
           'libuser.userflag::aliases.post' => [
               'model'    => Catchphrase::class,
               'resource' => CatchphraseResource::class
           ]
        ]);
    }
}
