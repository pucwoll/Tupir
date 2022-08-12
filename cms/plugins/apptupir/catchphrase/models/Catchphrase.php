<?php namespace AppTupir\Catchphrase\Models;

use Rainlab\User\Models\User;
use October\Rain\Database\Model;
use Illuminate\Support\Facades\DB;

class Catchphrase extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'apptupir_catchphrases';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'title',
        'slug',
        'lyrics',
        'tags_string',
        'tags',
        'is_published',
        'user_id',
        'audio'
    ];

    /**
     * @var array Attributes to be cast to native types
     */

    protected $casts = [
        'is_published' => 'boolean'
    ];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'title'        => 'required',
        'slug'         => 'required',
        'uuid'         => [
            'regex:/(?!^\d+$)^[_A-z0-9\-]*$/',
            'unique:apptupir_catchphrases,uuid'
        ],
        'lyrics'       => 'required',
        'user'         => 'required',
        'audio'        => 'required',
        'is_published' => 'boolean'
    ];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [
        'user' => User::class
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function beforeCreate()
    {
        $this->uuid = str_random(5);

        while (DB::table($this->getTable())->where('uuid', $this->uuid)->exists()) {
            $this->uuid = str_random(5);
        }
    }

    public function getTagsAttribute()
    {
        return !is_null($this->tags_string) ? explode(' ', $this->tags_string) : $this->tags_string;
    }

    public function setTagsAttribute($value)
    {
        if ($value){
            $this->attributes['tags'] = implode(' ', array_unique($value));
        }
    }

    public function scopeIsPublished($query)
    {
        return $query->where('is_published', true);
    }
}
