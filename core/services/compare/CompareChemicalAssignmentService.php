<?php

namespace core\services\compare;

use core\entities\Compare\CompareChemicalAssignment;
use core\forms\compare\CompareChemicalAssignmentForm;
use core\repositories\compare\CompareChemicalAssignmentRepository;

class CompareChemicalAssignmentService
{
    /** @var CompareChemicalAssignmentRepository */
    protected $compareChemicalAssignments;

    /**
     * CompareChemicalAssignmentService constructor
     * @var CompareChemicalAssignmentRepository
     */
    public function __construct(CompareChemicalAssignmentRepository $compareChemicalAssignments)
    {
        $this->compareChemicalAssignments = $compareChemicalAssignments;
    }

    public function find($compare_id, $chemical_id): ?CompareChemicalAssignment
    {
        return $this->compareChemicalAssignments->find($compare_id, $chemical_id);
    }

    public function findByFuture($compare_id, $chemical_id): ?CompareChemicalAssignment
    {
        return $this->compareChemicalAssignments->findByFuture($compare_id, $chemical_id);
    }

    /**
     * @return CompareChemicalAssignment[]
     */
    public function findAll(): array
    {
        return $this->compareChemicalAssignments->findAll();
    }

    public function create(CompareChemicalAssignmentForm $form): CompareChemicalAssignment
    {
        $compareChemicalAssignment = CompareChemicalAssignment::create(
            $form->compare_id,
            $form->chemical_id
        );
        $this->compareChemicalAssignments->save($compareChemicalAssignment);
        return $compareChemicalAssignment;
    }

    public function edit($compare_id, $chemical_id, CompareChemicalAssignmentForm $form): void
    {
        $compareChemicalAssignment = $this->compareChemicalAssignments->get($compare_id, $chemical_id);
        $compareChemicalAssignment->edit(
            $form->compare_id,
            $form->chemical_id
        );
        $this->compareChemicalAssignments->save($compareChemicalAssignment);
    }

    public function remove($compare_id, $chemical_id): void
    {
        $compareChemicalAssignment = $this->compareChemicalAssignments->get($compare_id, $chemical_id);
        $this->compareChemicalAssignments->delete($compareChemicalAssignment);
    }

    public function removeAll(): void
    {
        $this->compareChemicalAssignments->deleteAll();
    }

    public function getRepository(): CompareChemicalAssignmentRepository
    {
        return $this->compareChemicalAssignments;
    }
}
