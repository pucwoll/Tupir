<?php namespace AppTupir\User\Classes\Extend;

use Backend\Widgets\Form;
use Rainlab\User\Models\User;
use RainLab\User\Controllers\Users;
use Illuminate\Support\Facades\Event;

class UserExtendDescription
{
    public static function addDescriptionToFields(){
        Users::extendFormFields(function(Form $form, $model) {

            if (!$model instanceof User) {
                return;
            }
            if ($form->alias !== 'form') {
                return;
            }

            $form->addFields([
                'description' => [
                    'label'   => 'Description',
                    'type'    => 'text',
                ],
            ]);
        });
    }

    public static function addDescriptionToResource()
    {
        Event::listen('libuser.userapi.user.beforeReturnResource', function(&$data, User $user){
            $data['description'] = $user->description;
        });
    }
}
