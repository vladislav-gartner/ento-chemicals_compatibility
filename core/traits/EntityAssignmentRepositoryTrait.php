<?php


namespace core\traits;


use core\entities\Kit\EntityAssignment;

trait EntityAssignmentRepositoryTrait
{

    /**
     * @param $submodel
     * @return EntityAssignment[]
     */
    public function findAllBySubmodel($project_id, $submodel): array
    {
        return EntityAssignment::findAll(['project_id' => $project_id, 'submodel' => $submodel]);
    }

    public function getByEntity($project_id, $entity): EntityAssignment
    {
        if (!$assignment = EntityAssignment::findOne(['project_id' => $project_id, 'entity' => $entity])) {
            throw new \core\repositories\NotFoundException('EntityAssignment is not found.');
        }
        return $assignment;
    }

    public function getByAssignment($project_id, $assignmentClass): EntityAssignment
    {
        if (!$entityAssignment = EntityAssignment::findOne(['project_id' => $project_id, 'assignment' => $assignmentClass])) {
            throw new \core\repositories\NotFoundException("EntityAssignment is not found. [project_id:{$project_id}, assignment:{$assignmentClass}]");
        }
        return $entityAssignment;
    }

    public function getBySubmodel($project_id, $submodelClass): EntityAssignment
    {
        if (!$entityAssignment = EntityAssignment::findOne(['project_id' => $project_id, 'submodel' => $submodelClass])) {
            throw new \core\repositories\NotFoundException('EntityAssignment is not found.');
        }
        return $entityAssignment;
    }

    public function getByEntityWithSubmodel($entityClass, $submodelClass): EntityAssignment
    {
        if (!$entityAssignment = EntityAssignment::findOne(['entity' => $entityClass, 'submodel' => $submodelClass])) {
            throw new \core\repositories\NotFoundException("EntityAssignment is not found. [entityClass:{$entityClass}, submodel:{$submodelClass}]");
        }
        return $entityAssignment;
    }

}