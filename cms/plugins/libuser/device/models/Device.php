<?php namespace LibUser\Device\Models;

use October\Rain\Database\Model;
use RainLab\User\Models\User;

/**
 * Device Model
 */
class Device extends Model
{
    use \October\Rain\Database\Traits\SoftDelete;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'libuser_device_devices';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'token',
        'platform',
        'manufacturer',
        'model',
        'os',
        'os_version',
        'app_version',
        'app_build',
        'uuid',
        'raw_data'
    ];

    /**
     * @var array Jsonable fields
     */
    protected $jsonable = [
        'raw_data',
    ];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'expire_at',
    ];

    public $belongsTo = [
        User::class
    ];

    public function beforeCreate()
    {
        $this->setExpireAt();
    }

    public function afterCreate()
    {
        // Po zaregistrovani noveho zariadenia musime oznacit ako zmazane vsetky zaznamy ktore maju rovnake uuid,
        // pretoze v rovnakom case mozeme mat len jedno aktivne zariadenie
        self::where('uuid',$this->uuid)
            ->where('id','!=',$this->id)
            ->delete();
    }

    public function beforeSave()
    {
        if ( $this->isDirty('raw_data') ) {
            $this->fillFromRawData();
        }
    }

    private function fillFromRawData()
    {
        $data = $this->raw_data;

        $this->token = array_get($data,'token');
        $this->platform = array_get($data,'platform');
        $this->manufacturer = array_get($data,'manufacturer');
        $this->model = array_get($data,'model');
        $this->os = array_get($data,'operatingSystem');
        $this->os_version = array_get($data,'osVersion');
        $this->app_version = array_get($data,'appVersion');
        $this->app_build = array_get($data,'appBuild');
        $this->uuid = array_get($data,'uuid');
    }

    private function setExpireAt()
    {
        $ttl = config('libuser.userapi::refresh_ttl');
        $this->expire_at = now()->addMinutes($ttl);
    }
}
