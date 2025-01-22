<?php


namespace core\traits;


use core\entities\Kit\EntityAssignment;

trait EntityAssignmentServiceTrait
{

    /**
     * @param $project_id
     * @param $assignmentClass
     * @return EntityAssignment[]
     */
    public function findAllBySubmodel($project_id, $assignmentClass): array
    {
        return $this->entityAssignments->findAllBySubmodel($project_id, $assignmentClass);
    }

    public function getByEntity($project_id, $table): EntityAssignment
    {
        return $this->entityAssignments->getByEntity($project_id, $table);
    }

    public function getByAssignment($project_id, $assignmentClass): EntityAssignment
    {
        return $this->entityAssignments->getByAssignment($project_id, $assignmentClass);
    }

    public function getBySubmodel($project_id, $assignmentClass): EntityAssignment
    {
        return $this->entityAssignments->getBySubmodel($project_id, $assignmentClass);
    }

    public function getByEntityWithSubmodel($entityClass, $assignmentClass): EntityAssignment
    {
        return $this->entityAssignments->getByEntityWithSubmodel($entityClass, $assignmentClass);
    }

}