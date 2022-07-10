<?php namespace W\Importer\Classes\Seeder\Relations;

class BelongsToManySeeder extends RelationSeeder
{
    public function fill()
    {
        $items = [];
        foreach ($this->data as $modelData) {
            $relatedModel = $this->getRelatedModel($modelData);

            $items[] = $relatedModel;
        }

        $this->relation->setSimpleValue($items);

        return $this->relation;
    }
}
