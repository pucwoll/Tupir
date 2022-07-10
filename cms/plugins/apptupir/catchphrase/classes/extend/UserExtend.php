<?php namespace AppTupir\Catchphrase\Classes\Extend;

use RainLab\User\Models\User;
use AppTupir\Catchphrase\Models\Catchphrase;

class UserExtend
{
    public static function addCatchphraseRelationToUser()
    {
        User::extend(function($model) {
            $model->hasMany['catchphrases'] = [
                Catchphrase::class,
                'order' => 'created_at desc'
            ];

            $model->hasMany['catchphrases_count'] = [
                Catchphrase::class,
                'count' => true
            ];
        });
    }
}
