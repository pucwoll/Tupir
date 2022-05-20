<?php namespace AppTupir\User\Classes\Extend;

use Backend\Widgets\Form;
use Rainlab\User\Models\User;
use RainLab\User\Controllers\Users;
use Illuminate\Support\Facades\Event;

class UserExtendCreator
{
    public static function addCreatorToFields(){
        Users::extendFormFields(function(Form $form, $model) {

            if (!$model instanceof User) {
                return;
            }
            if ($form->alias !== 'form') {
                return;
            }

            $form->addFields([
                'is_creator' => [
                    'label'   => 'Is creator',
                    'type'    => 'switch',
                    'default' => 'false',
                ],
            ]);
        });
    }

    public static function addCreatorToColumns(){
        Users::extendListColumns(function($column, $model) {

            if (!$model instanceof User) {
                return;
            }

            $column->addColumns([
                'is_creator' => [
                    'label' => 'Is creator',
                    'type'  => 'switch',
                ],
            ]);
        });
    }

    public static function addCreatorToResource()
    {
        Event::listen('libuser.userapi.user.beforeReturnResource', function(&$data, User $user){
            $data['is_creator'] = $user->is_creator;
        });
    }
}
