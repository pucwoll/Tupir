<?php namespace LibUser\UserFlag\Classes\Extend;

use RainLab\User\Models\User;
use LibUser\UserFlag\Models\UserFlag;

class UserExtend
{
    /*
     * Add method to user for getting flagged models
     */
    public static function addMethod_getFlaggedModels()
    {
        User::extend(function(User $user) {
            $user->addDynamicMethod('getFlaggedModels', function($modelClass, $requestedTypes = null) use ($user) {
                
                $query = UserFlag::with('flaggable')
                    ->where('user_id', $user->id)
                    ->where('flaggable_type', $modelClass);
                
                if ($requestedTypes) {
                    $types = $requestedTypes;
                    
                    if (is_string($requestedTypes)) {
                        $types = collect(explode(',', $requestedTypes))->map(function($type) {
                            return trim($type);
                        });
                    }
                    
                    
                    $query->whereIn('type', $types);
                }
                
                // Todo: probably temporary
                $query->where('value', '>', 0);
                
                $flags = $query->get();
                
                return $flags->pluck('flaggable');
            });
        });
    }
}