<?php namespace AppMemeTime\ImporterExtend\Classes\Hooks;

use Illuminate\Support\Arr;
use October\Rain\Database\Model;
use October\Rain\Support\Facades\Event;
use AppTupir\Catchphrase\Models\Catchphrase;

class ImporterHook
{
    public static function beforeSave_setIsPublishedAndThumbnail()
    {
        Event::listen('w.importer.beforeSave', function (Model $model, $modelData) {
            self::_allModelsEvent($model, $modelData);

            if (!$model instanceof Catchphrase && $model->title) {
                return;
            }

            $model->title = $model->slug;
        });
    }


    protected static function _allModelsEvent(Model $model, $modelData)
    {
        if (get_class($model) != Catchphrase::class) {
            return;
        }

        if (Arr::exists($modelData, 'is_published')) {
            return;
        }

        $model->is_published = true;
    }
}
