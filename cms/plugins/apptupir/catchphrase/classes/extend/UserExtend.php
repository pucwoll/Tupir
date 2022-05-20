<?php namespace AppTupir\Catchphrase\Classes\Extend;

use RainLab\User\Models\User;
use AppTupir\Catchphrase\Models\Catchphrase;

class UserExtend
{
    public static function addCatchphraseRelationToUser()
    {
        User::extend(function($model) {
            $model->hasMany['catchphrases'] = Catchphrase::class;
        });
    }

    public static function addIsCreatorToUser()
    {
        User::extend(function($model) {
            $model->addDynamicMethod('scopeIsCreator', function ($query) use ($model) {
                return $query->where('is_creator', true);
            });
        });
    }
}
