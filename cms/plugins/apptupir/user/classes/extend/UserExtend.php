<?php namespace AppTupir\User\Classes\Extend;

use Backend\Widgets\Form;
use Rainlab\User\Models\User;
use October\Rain\Database\Model;
use RainLab\User\Controllers\Users;

class UserExtend
{
    public static function updateFormFields_addSuperUserSwitch()
    {
        Users::extendFormFields(function(Form $form, Model $model, $context) {
            if (!$model instanceof User) {
                return;
            }
            if ($form->alias !== 'form') {
                return;
            }

            $form->addFields([
                'is_superuser' => [
                    'label'   => 'Superuser',
                    'type'    => 'switch',
                    'default' => 'false',
                    'disabled' => $form->context === 'preview'
                ],
            ]);
        });
    }
}
