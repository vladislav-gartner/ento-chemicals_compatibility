<?php


namespace core\traits;


use backend\components\dto\DTOPartialProperty;
use core\entities\Kit\EntityPartial;
use yii\db\ColumnSchema;

trait EntityPartialServiceTrait
{

    public function findByEntity($project_id, $entity): ?EntityPartial
    {
        return $this->entityPartials->findByEntity($project_id, $entity);
    }

    public function getListPartialProperties(EntityPartial $entityPartial): ?array
    {
        if ($entityPartial && is_array($entityPartial->field_multiple)){
            $result = [];
            foreach ($entityPartial->field_multiple as $item){
                $item = (object)$item;
                $result[$item->field] = new DTOPartialProperty($item->field, $item->editable_in_view, $item->editable_in_index);
            }

            return $result;
        }

        return null;
    }

    /**
     * @param $project_id
     * @param $entity
     * @return DTOPartialProperty[]
     */
    public function getProperties($project_id, $entity): array
    {
        /** @var EntityPartial $entityPartial */
        $entityPartial = $this->findByEntity($project_id, $entity);

        if ($entityPartial) {
            if ($properties = $this->getListPartialProperties($entityPartial)) {
                return $properties;
            }
        }
        return [];
    }

    public function getProperty($project_id, $entity, ColumnSchema $column): ?DTOPartialProperty
    {
        /** @var EntityPartial $entityPartial */
        $entityPartial = $this->findByEntity($project_id, $entity);

        if ($entityPartial){
            if ($properties = $this->getListPartialProperties($entityPartial)){

                /** @var DTOPartialProperty $property */
                $property = $properties[$column->name];

                if ($property){
                    return $property;
                }
            }
        }

        return null;
    }
}