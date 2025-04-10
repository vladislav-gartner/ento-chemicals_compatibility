<?php

namespace core\services\compare;

use core\entities\Compare\CompareEntomophageAssignment;
use core\forms\compare\CompareEntomophageAssignmentForm;
use core\repositories\compare\CompareEntomophageAssignmentRepository;

class CompareEntomophageAssignmentService
{
    /** @var CompareEntomophageAssignmentRepository */
    protected $compareEntomophageAssignments;

    /**
     * CompareEntomophageAssignmentService constructor
     * @var CompareEntomophageAssignmentRepository
     */
    public function __construct(CompareEntomophageAssignmentRepository $compareEntomophageAssignments)
    {
        $this->compareEntomophageAssignments = $compareEntomophageAssignments;
    }

    public function find($compare_id, $entomophage_id): ?CompareEntomophageAssignment
    {
        return $this->compareEntomophageAssignments->find($compare_id, $entomophage_id);
    }

    public function findByFuture($compare_id, $entomophage_id): ?CompareEntomophageAssignment
    {
        return $this->compareEntomophageAssignments->findByFuture($compare_id, $entomophage_id);
    }

    /**
     * @return CompareEntomophageAssignment[]
     */
    public function findAll(): array
    {
        return $this->compareEntomophageAssignments->findAll();
    }

    public function create(CompareEntomophageAssignmentForm $form): CompareEntomophageAssignment
    {
        $compareEntomophageAssignment = CompareEntomophageAssignment::create(
            $form->compare_id,
            $form->entomophage_id
        );
        $this->compareEntomophageAssignments->save($compareEntomophageAssignment);
        return $compareEntomophageAssignment;
    }

    public function edit($compare_id, $entomophage_id, CompareEntomophageAssignmentForm $form): void
    {
        $compareEntomophageAssignment = $this->compareEntomophageAssignments->get($compare_id, $entomophage_id);
        $compareEntomophageAssignment->edit(
            $form->compare_id,
            $form->entomophage_id
        );
        $this->compareEntomophageAssignments->save($compareEntomophageAssignment);
    }

    public function remove($compare_id, $entomophage_id): void
    {
        $compareEntomophageAssignment = $this->compareEntomophageAssignments->get($compare_id, $entomophage_id);
        $this->compareEntomophageAssignments->delete($compareEntomophageAssignment);
    }

    public function removeAll(): void
    {
        $this->compareEntomophageAssignments->deleteAll();
    }

    public function getRepository(): CompareEntomophageAssignmentRepository
    {
        return $this->compareEntomophageAssignments;
    }
}
