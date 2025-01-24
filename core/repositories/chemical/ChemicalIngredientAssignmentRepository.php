<?php

namespace core\repositories\chemical;

use core\entities\Chemical\ChemicalIngredientAssignment;

class ChemicalIngredientAssignmentRepository
{
    public function get($chemical_id, $ingredient_id): ChemicalIngredientAssignment
    {
        if (!$chemicalIngredientAssignment = ChemicalIngredientAssignment::findOne(['chemical_id' => $chemical_id, 'ingredient_id' => $ingredient_id])) {
            throw new \core\repositories\NotFoundException('ChemicalIngredientAssignment is not found.');
        }
        return $chemicalIngredientAssignment;
    }

    public function find($chemical_id, $ingredient_id): ?ChemicalIngredientAssignment
    {
        return ChemicalIngredientAssignment::find()->andWhere(['chemical_id' => $chemical_id, 'ingredient_id' => $ingredient_id])->one();
    }

    /**
     * @return ChemicalIngredientAssignment[]
     */
    public function findAll(): array
    {
        return ChemicalIngredientAssignment::find()->all();
    }

    public function findByFuture($chemical_id, $ingredient_id, $name): ?ChemicalIngredientAssignment
    {
        return ChemicalIngredientAssignment::findOne([
            'chemical_id' => $chemical_id,
            'ingredient_id' => $ingredient_id,
            'name' => $name,
        ],);
    }

    public function save(ChemicalIngredientAssignment $chemicalIngredientAssignment): void
    {
        if (!$chemicalIngredientAssignment->save()) {
            throw new \RuntimeException("Saving error. {$chemicalIngredientAssignment->plainErrors()}");
        }
    }

    public function delete(ChemicalIngredientAssignment $chemicalIngredientAssignment): void
    {
        if (!$chemicalIngredientAssignment->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        ChemicalIngredientAssignment::deleteAll();
    }
}
