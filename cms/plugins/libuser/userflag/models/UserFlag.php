<?php namespace LibUser\UserFlag\Models;

use RainLab\User\Models\User;
use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\SoftDelete;

/**
 * UserFlag Model
 */
class UserFlag extends Model
{
    use Validation;
    use SoftDelete;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'libuser_userflag_user_flags';
    
    
    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'flaggable_type',
        'flaggable_id',
        'user_id',
        'type',
        'value',
        'text',
    ];
    
    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'flaggable_id'   => 'required',
        'flaggable_type' => 'required',
    ];
    
    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    /**
     * @var array Relations
     */
    public $morphTo = [
        'flaggable' => [],
    ];
    public $belongsTo = [
        'user' => User::class,
    ];
    
}
