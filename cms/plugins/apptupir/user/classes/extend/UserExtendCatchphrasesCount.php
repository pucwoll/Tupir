<?php namespace AppTupir\User\Classes\Extend;

use Rainlab\User\Models\User;
use RainLab\User\Controllers\Users;
use Illuminate\Support\Facades\Event;

class UserExtendCatchphrasesCount
{
    public static function addCatchphrasesCountToColumns(){
        Users::extendListColumns(function($column, $model) {

            if (!$model instanceof User) {
                return;
            }

            $column->addColumns([
                'catchphrases_count' => [
                    'label'            => 'Catchphrases count',
                    'type'             => 'number',
                    'relation'         => 'catchphrases_count',
                    'useRelationCount' => 'true',
                ],
            ]);
        });
    }

    public static function addCatchphrasesCountToResource()
    {
        Event::listen('libuser.userapi.user.beforeReturnResource', function(&$data, User $user){
            $data['catchphrases_count'] = $user->catchphrases_count;
        });
    }
}
