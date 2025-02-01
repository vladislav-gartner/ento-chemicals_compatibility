<?php

namespace core\services\chemical;

use core\entities\Chemical\ChemicalIngredientAssignment;
use core\forms\chemical\ChemicalIngredientAssignmentForm;
use core\repositories\chemical\ChemicalIngredientAssignmentRepository;

class ChemicalIngredientAssignmentService
{
    /** @var ChemicalIngredientAssignmentRepository */
    protected $chemicalIngredientAssignments;

    /**
     * ChemicalIngredientAssignmentService constructor
     * @var ChemicalIngredientAssignmentRepository
     */
    public function __construct(ChemicalIngredientAssignmentRepository $chemicalIngredientAssignments)
    {
        $this->chemicalIngredientAssignments = $chemicalIngredientAssignments;
    }

    public function find($chemical_id, $ingredient_id): ?ChemicalIngredientAssignment
    {
        return $this->chemicalIngredientAssignments->find($chemical_id, $ingredient_id);
    }

    public function findByFuture($chemical_id, $ingredient_id, $name): ?ChemicalIngredientAssignment
    {
        return $this->chemicalIngredientAssignments->findByFuture($chemical_id, $ingredient_id, $name);
    }

    /**
     * @return ChemicalIngredientAssignment[]
     */
    public function findAll(): array
    {
        return $this->chemicalIngredientAssignments->findAll();
    }

    public function create(ChemicalIngredientAssignmentForm $form): ChemicalIngredientAssignment
    {
        $chemicalIngredientAssignment = ChemicalIngredientAssignment::create(
            $form->chemical_id,
            $form->ingredient_id
        );
        $this->chemicalIngredientAssignments->save($chemicalIngredientAssignment);
        return $chemicalIngredientAssignment;
    }

    public function edit($chemical_id, $ingredient_id, ChemicalIngredientAssignmentForm $form): void
    {
        $chemicalIngredientAssignment = $this->chemicalIngredientAssignments->get($chemical_id, $ingredient_id);
        $chemicalIngredientAssignment->edit(
            $form->chemical_id,
            $form->ingredient_id
        );
        $this->chemicalIngredientAssignments->save($chemicalIngredientAssignment);
    }

    public function remove($chemical_id, $ingredient_id): void
    {
        $chemicalIngredientAssignment = $this->chemicalIngredientAssignments->get($chemical_id, $ingredient_id);
        $this->chemicalIngredientAssignments->delete($chemicalIngredientAssignment);
    }

    public function removeAll(): void
    {
        $this->chemicalIngredientAssignments->deleteAll();
    }

    public function truncate(): void
    {
        $this->chemicalIngredientAssignments->truncate();
    }

    public function getRepository(): ChemicalIngredientAssignmentRepository
    {
        return $this->chemicalIngredientAssignments;
    }
}
