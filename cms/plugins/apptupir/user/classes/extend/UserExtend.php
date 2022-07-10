<?php namespace AppTupir\User\Classes\Extend;

use Backend\Widgets\Form;
use Rainlab\User\Models\User;
use October\Rain\Database\Model;
use RainLab\User\Controllers\Users;
use Illuminate\Support\Facades\Event;

class UserExtend
{
    public static function onScopeCanSee_filterPublished()
    {
        Event::listen('libuser.block.scopeCanSee', function ($query) {
            $query->isPublished();
        });
    }

    public static function addIsPublishedScope()
    {
        User::extend(function ($user) {
            $user->addDynamicMethod('scopeIsPublished', function ($query) {
                return $query->where('is_published', true);
            });
        });
    }

    public static function addIsPublishedAsFillable()
    {
        User::extend(function (User $user) {
            $user->addFillable('is_published');
        });
    }

    public static function updateFormFields_addIsPublishedSwitch()
    {
        Users::extendFormFields(function(Form $form, Model $model) {
            if (!$model instanceof User) {
                return;
            }
            if ($form->alias !== 'form') {
                return;
            }

            $form->addFields([
                'is_published' => [
                    'label'   => 'Published',
                    'type'    => 'switch',
                    'default' => 'true',
                    'span'    => 'right',
                    'disabled' => $form->context === 'preview'
                ],
            ]);
        });
    }

    public static function updateListColumns_addIsPublishedSwitch()
    {
        Users::extendListColumns(function($column, $model) {

            if (!$model instanceof User) {
                return;
            }

            if ($column->alias !== 'list') {
                return;
            }

            $column->addColumns([
                'is_published' => [
                    'label'  => 'Is published',
                    'type'   => 'switch',
                ],
            ]);
        });
    }

    public static function extendUserResource()
    {
        Event::listen('libuser.userapi.user.beforeReturnResource', function (&$data, User $user) {
            $data['bio'] = $user->bio;
        });
    }

    public static function addBioAsFillableToUser()
    {
        User::extend(function (User $user) {
            $user->addFillable('bio');
        });
    }

    public static function updateFormFields_addUsernameField()
    {
        Users::extendFormFields(function(Form $form, Model $model) {
            if (!$model instanceof User) {
                return;
            }
            if ($form->alias !== 'form') {
                return;
            }

            $form->addFields([
                'username' => [
                    'label' => 'Username',
                    'type'  => 'text',
                    'span'  => 'full'
                ],
            ]);
        });
    }

    public static function updateFormFields_addBioField()
    {
        Users::extendFormFields(function(Form $form, Model $model) {
            if (!$model instanceof User) {
                return;
            }
            if ($form->alias !== 'form') {
                return;
            }

            $form->addFields([
                'bio' => [
                    'label' => 'Bio',
                    'type'  => 'richeditor',
                    'span'  => 'full'
                ],
            ]);
        });
    }

    public static function updateFormFields_addSuperUserSwitch()
    {
        Users::extendFormFields(function(Form $form, Model $model) {
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
                    'span'    => 'left',
                    'disabled' => $form->context === 'preview'
                ],
            ]);
        });
    }
}
