<?php namespace LibUser\UserFlag\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use LibUser\UserFlag\Models\UserFlag;
use LibUser\UserFlag\Http\Resources\UserFlagResource;

class UserFlagController extends Controller
{
    /*
     * Create or update
     */
    public function storeOrUpdate(Request $request, $model, $id, User $user)
    {
        $modelClass = $this->_getModelClassFromAlias($model);
        
        $flag = UserFlag::firstOrNew([
            'flaggable_type' => $modelClass,
            'flaggable_id'   => $id,
            'user_id'        => $user->id,
            'type'           => $request->input('type'),
        ]);

        $flag->value = $request->input('value');
        $flag->text = $request->input('text');

        $flag->save();
        
        return new UserFlagResource($flag);
    }
    
    /*
     * Get models with given type
     */
    public function getModels_modelAndType(Request $request, $model, $type, User $user)
    {
        $modelClass = $this->_getModelClassFromAlias($model);

        $resourceClass = config('libuser.userflag::aliases.' . $model . '.resource');
        $models = $user->getFlaggedModels($modelClass, $type);
        
        return $resourceClass::collection($models);
    }
    
    /*
     * Returns flags for specific model
     */
    public function getFlags_modelAndId(Request $request, $model, $id, User $user)
    {
        $modelClass = $this->_getModelClassFromAlias($model);
        
        $flags = UserFlag::where([
            'user_id'        => $user->id,
            'flaggable_type' => $modelClass,
            'flaggable_id'   => $id,
        ])->get();
        
        return UserFlagResource::collection($flags);
    }
    
    /*
     * Returns flags for all models
     */
    public function getFlags_model(Request $request, $model, User $user)
    {
        $modelClass = $this->_getModelClassFromAlias($model);
        
        $flags = UserFlag::where([
            'user_id'        => $user->id,
            'flaggable_type' => $modelClass,
        ])->get();
        
        return UserFlagResource::collection($flags);
    }
    
    /*
     * Get all models with given type
     */
    public function getModels_type(Request $request, $type, User $user)
    {
        $flags = UserFlag::where([
            'user_id' => $user->id,
            'type'    => $type,
        ])->get();

        return UserFlagResource::collection($flags);
    }
    
    /*
     * Get model class from alias and throw error if not found
     */
    protected function _getModelClassFromAlias($model)
    {
        if (!array_key_exists($model, config('libuser.userflag::aliases', []))) {
            throw new Exception('Model not allowed');
        }

        return config('libuser.userflag::aliases.' . $model . '.model');
    }
}