<?php namespace AppTupir\User\Classes\Extend;

use Exception;
use Backend\Widgets\Form;
use Rainlab\User\Models\User;
use October\Rain\Database\Model;
use Illuminate\Support\Facades\DB;
use RainLab\User\Controllers\Users;
use Illuminate\Support\Facades\Event;
use LibUser\UserFlag\Models\UserFlag;
use October\Rain\Support\Facades\Mail;
use AppTupir\Catchphrase\Models\Catchphrase;
use AppTupir\User\Http\Resources\SimpleUserResource;
use AppTupir\Catchphrase\Http\Resources\CatchphraseResource;

class UserExtend
{
    public static function addUUIDToUser()
    {
        User::extend(function($user) {
            $user->bindEvent('model.beforeCreate', function() use ($user) {
                $user->uuid = str_random(5);

                while (DB::table($user->getTable())->where('uuid', $user->uuid)->exists()) {
                    $user->uuid = str_random(5);
                }
            });

            $user->rules['uuid'] = [
                'regex:/(?!^\d+$)^[_A-z0-9\-]*$/',
                'unique:users,uuid'
            ];
        });
    }

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
                    'label'    => 'Published',
                    'type'     => 'switch',
                    'default'  => 'true',
                    'span'     => 'right',
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
                    'label' => 'Is published',
                    'type'  => 'switch'
                ],
            ]);
        });
    }

    public static function updateListColumns_removeSurname()
    {
        Users::extendListColumns(function($column, $model) {

            if (!$model instanceof User) {
                return;
            }

            if ($column->alias !== 'list') {
                return;
            }

            $column->removeColumn('surname');
        });
    }

    public static function addFollowingRelationToUser()
    {
        User::extend(function ($user) {
            $user->hasMany['following'] = [
                UserFlag::class,
                'key'        => 'user_id',
                'conditions' => "type = 'follow' AND value = 1 AND flaggable_type = 'RainLab\\\User\\\Models\\\User'",
                'order'      => 'updated_at desc'
            ];
        });
    }

    public static function addFollowersRelationToUser()
    {
        User::extend(function ($user) {
            $user->morphMany['followers'] = [
                UserFlag::class,
                'name'       => 'flaggable',
                'conditions' => "type = 'follow' AND value = 1 AND flaggable_type = 'RainLab\\\User\\\Models\\\User'",
                'order'      => 'updated_at desc'
            ];
        });
    }

    public static function addLikesRelationToUser()
    {
        User::extend(function (User $user) {
            $user->hasMany['likes'] = [
                UserFlag::class,
                'name'       => 'flaggable',
                'conditions' => "type = 'like' AND value = 1 AND flaggable_type = 'AppTupir\\\Catchphrase\\\Models\\\Catchphrase'",
                'order'      => 'updated_at desc'
            ];
        });
    }

    public static function addBookmarksRelationToUser()
    {
        User::extend(function (User $user) {
            $user->hasMany['bookmarks'] = [
                UserFlag::class,
                'conditions' => "type = 'bookmark' AND value = 1 AND flaggable_type = 'AppTupir\\\Catchphrase\\\Models\\\Catchphrase'",
                'order'      => 'updated_at desc'
            ];
        });
    }

    public static function addSharesRelationToUser()
    {
        User::extend(function (User $user) {
            $user->hasMany['shares'] = [
                UserFlag::class,
                'conditions' => "type = 'share' AND value = 1 AND flaggable_type = 'AppTupir\\\Catchphrase\\\Models\\\Catchphrase'",
                'order'      => 'updated_at desc'
            ];
        });
    }

    public static function addPlaysRelationToUser()
    {
        User::extend(function (User $user) {
            $user->hasMany['plays'] = [
                UserFlag::class,
                'conditions' => "type = 'play' AND value = 1 AND flaggable_type = 'AppTupir\\\Catchphrase\\\Models\\\Catchphrase'",
                'order'      => 'updated_at desc'
            ];
        });
    }

    public static function addVisitsRelationToUser()
    {
        User::extend(function (User $user) {
            $user->hasMany['visits'] = [
                UserFlag::class,
                'conditions' => "type = 'visit' AND value = 1 AND flaggable_type = 'AppTupir\\\Catchphrase\\\Models\\\Catchphrase'",
                'order'      => 'updated_at desc'
            ];
        });
    }

    public static function addCatchphraseRelationToUser()
    {
        User::extend(function (User $user) {
            $user->hasMany['catchphrases'] = [
                Catchphrase::class,
                'order'      => 'created_at desc',
                'softDelete' => true,
                'delete'     => true
            ];
        });
    }

    public static function extendUserResource()
    {
        Event::listen('libuser.userapi.user.beforeReturnResource', function (&$data, User $user) {
            $data['bio'] = $user->bio;

            $data['following'] = SimpleUserResource::collection($user->following->pluck('flaggable')->filter()->sortByDesc('created_at'));
            $data['followers'] = SimpleUserResource::collection($user->followers->pluck('user')->filter()->sortByDesc('created_at'));

            $data['likes'] = CatchphraseResource::collection($user->likes->pluck('flaggable')->sortByDesc('created_at'));
            $data['comments'] = CatchphraseResource::collection(Catchphrase::find($user->comments->pluck('commentable_id'))->where('is_published', true)->sortByDesc('created_at'));
            $data['bookmarks'] = CatchphraseResource::collection($user->bookmarks->pluck('flaggable')->sortByDesc('created_at'));
            $data['catchphrases'] = CatchphraseResource::collection($user->catchphrases()->where('is_published', true)->orderByDesc('created_at')->get());
        });
    }

    public static function addBioAsFillableToUser()
    {
        User::extend(function (User $user) {
            $user->addFillable('bio');
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
                    'type'  => 'textarea',
                    'size'  => 'large',
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
                    'label'    => 'Superuser',
                    'type'     => 'switch',
                    'default'  => 'false',
                    'span'     => 'left',
                    'disabled' => $form->context === 'preview'
                ],
            ]);
        });
    }

    public static function deleteUserFlags_onUserDelete()
    {
        User::extend(function (User $user) {
            $user->bindEvent('model.beforeDelete', function () use ($user) {
                DB::table('libuser_userflag_user_flags')
                    ->where('user_id', $user->id)
                    ->where('type', '<>', 'visit')
                    ->delete();
            });
        });
    }

    public static function beforeShowCatchphrase_checkPublished()
    {
        Event::listen('apptupir.catchphrase.action.show', function ($catchphrase) {
            if (!$catchphrase->user->is_published) {
                throw new Exception('Catchphrase not found', 404);
            }
        });
    }

    public static function addCatchphrasesCountToColumns(){
        Users::extendListColumns(function($column, $model) {

            if (!$model instanceof User) {
                return;
            }

            $column->addColumns([
                'catchphrases_count' => [
                    'label'            => 'Catchphrases',
                    'type'             => 'number',
                    'relation'         => 'catchphrases',
                    'useRelationCount' => 'true'
                ]
            ]);
        });
    }

    public static function addCatchphrasesCountToResource()
    {
        Event::listen('libuser.userapi.user.beforeReturnResource', function(&$data, User $user){
            $data['catchphrases_count'] = Catchphrase::isPublished()->where('user_id', $user->id)->count();
        });
    }

    public static function setMailTemplateForForgottenPassword()
    {
        Event::listen('libuser.userapi.sendResetPasswordCode', function ($user, $code) {
            $vars = [
                'code' => $code
            ];

            Mail::send('apptupir.user::mail.reset-password', $vars, function ($message) use ($user) {
                $message->to($user->email);
            });
        });
    }
}
