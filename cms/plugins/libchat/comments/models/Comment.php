<?php namespace LibChat\Comments\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\SoftDelete;
use October\Rain\Database\Traits\SimpleTree;

/**
 * Comment Model
 */
class Comment extends Model
{
    use SimpleTree;
    use SoftDelete;
    use Validation;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'libchat_comments_comments';
    
    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'content',
    ];
    
    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'commentable_type' => 'required',
        'commentable_id'   => 'required',
        'content'          => 'required',
    ];
    
    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [
        'commentable_id' => 'int',
    ];
    
    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
    /**
     * @var array Relations
     */
    public $morphTo = [
        'commentable' => [],
        'creatable'   => [],
    ];
    public $morphMany = [
        'answers' => [
            Comment::class,
            'name' => 'commentable',
        ],
    ];
}
