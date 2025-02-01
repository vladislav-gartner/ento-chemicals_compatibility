<?php

namespace core\repositories\compare;

use core\entities\Compare\CompareEntomophageAssignment;

class CompareEntomophageAssignmentRepository
{
    public function get($compare_id, $entomophage_id): CompareEntomophageAssignment
    {
        if (!$compareEntomophageAssignment = CompareEntomophageAssignment::findOne(['compare_id' => $compare_id, 'entomophage_id' => $entomophage_id])) {
            throw new \core\repositories\NotFoundException('CompareEntomophageAssignment is not found.');
        }
        return $compareEntomophageAssignment;
    }

    public function find($compare_id, $entomophage_id): ?CompareEntomophageAssignment
    {
        return CompareEntomophageAssignment::find()->andWhere(['compare_id' => $compare_id, 'entomophage_id' => $entomophage_id])->one();
    }

    /**
     * @return CompareEntomophageAssignment[]
     */
    public function findAll(): array
    {
        return CompareEntomophageAssignment::find()->all();
    }

    public function findByFuture($compare_id, $entomophage_id, $name): ?CompareEntomophageAssignment
    {
        return CompareEntomophageAssignment::findOne([
            'compare_id' => $compare_id,
            'entomophage_id' => $entomophage_id,
            'name' => $name,
        ],);
    }

    public function save(CompareEntomophageAssignment $compareEntomophageAssignment): void
    {
        if (!$compareEntomophageAssignment->save()) {
            throw new \RuntimeException("Saving error. {$compareEntomophageAssignment->plainErrors()}");
        }
    }

    public function delete(CompareEntomophageAssignment $compareEntomophageAssignment): void
    {
        if (!$compareEntomophageAssignment->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        CompareEntomophageAssignment::deleteAll();
    }
}
