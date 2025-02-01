<?php

namespace core\repositories\compare;

use core\entities\Compare\CompareChemicalAssignment;

class CompareChemicalAssignmentRepository
{
    public function get($compare_id, $chemical_id): CompareChemicalAssignment
    {
        if (!$compareChemicalAssignment = CompareChemicalAssignment::findOne(['compare_id' => $compare_id, 'chemical_id' => $chemical_id])) {
            throw new \core\repositories\NotFoundException('CompareChemicalAssignment is not found.');
        }
        return $compareChemicalAssignment;
    }

    public function find($compare_id, $chemical_id): ?CompareChemicalAssignment
    {
        return CompareChemicalAssignment::find()->andWhere(['compare_id' => $compare_id, 'chemical_id' => $chemical_id])->one();
    }

    /**
     * @return CompareChemicalAssignment[]
     */
    public function findAll(): array
    {
        return CompareChemicalAssignment::find()->all();
    }

    public function findByFuture($compare_id, $chemical_id, $name): ?CompareChemicalAssignment
    {
        return CompareChemicalAssignment::findOne([
            'compare_id' => $compare_id,
            'chemical_id' => $chemical_id,
            'name' => $name,
        ],);
    }

    public function save(CompareChemicalAssignment $compareChemicalAssignment): void
    {
        if (!$compareChemicalAssignment->save()) {
            throw new \RuntimeException("Saving error. {$compareChemicalAssignment->plainErrors()}");
        }
    }

    public function delete(CompareChemicalAssignment $compareChemicalAssignment): void
    {
        if (!$compareChemicalAssignment->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        CompareChemicalAssignment::deleteAll();
    }
}
