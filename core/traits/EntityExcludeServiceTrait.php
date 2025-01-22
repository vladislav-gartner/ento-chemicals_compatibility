<?php


namespace core\traits;

use core\entities\Kit\EntityExclude;

trait EntityExcludeServiceTrait
{
    protected function createEntityFieldPool($project_id): array
    {
        $entityExcludes = EntityExclude::find()
            ->where(['project_id' => $project_id])
            ->asArray()->all();

        $result = [];
        foreach ($entityExcludes as $entityExclude){
            $entity = $entityExclude['entity'];
            $field = $entityExclude['field'];

            $result[$entity][] = $field;
        }
        return $result;
    }

    public function getEntityBuffer(): array
    {
        return $this->entity_buffer;
    }

    public function getExcludesByClass($className)
    {
        if (array_key_exists($className, $this->entity_buffer)){
            return $this->entity_buffer[$className];
        }
        return [];
    }
}