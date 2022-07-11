<?php namespace LibUser\Role\Classes\Extend;

use Backend\Widgets\Form;
use RainLab\User\Models\User;
use Illuminate\Validation\Rule;
use October\Rain\Database\Model;
use RainLab\User\Controllers\Users;
use Illuminate\Support\Facades\Event;

class UserExtend
{
    
    /*
     * Add roles attribute
     */
    public static function addRules_userRoleIsInDefinedConfig()
    {
        User::extend(function(User $user) {
            $user->rules['user_role'] = Rule::in(config('libuser.role::roles'));
        });
    }
    
    /*
     * Update Form Fields
     */
    public static function updateFormFields_addSelectorForUserRoles()
    {
        Users::extendFormFields(function(Form $form, Model $model, $context) {
            
            if (!$model instanceof User) {
                return;
            }
            if ($form->alias !== 'form') {
                return;
            }
            
            $roles = config('libuser.role::roles');
            
            $form->addFields([
                'user_role' => [
                    'label'   => 'Role',
                    'type'    => 'balloon-selector',
                    'default' => 'user',
                    'options' => array_combine($roles, $roles),
                ],
            ]);
        });
    }
    
    /*
     * Add user_role to resource
     */
    public static function updateResource_addUserRole()
    {
        Event::listen('libuser.userapi.user.beforeReturnResource', function(&$data, User $user) {
            $data['user_role'] = $user->user_role;
        });
    }
}