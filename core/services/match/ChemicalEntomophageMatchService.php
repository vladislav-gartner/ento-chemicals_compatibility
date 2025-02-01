<?php

namespace core\services\match;

use core\entities\Match\ChemicalEntomophageMatch;
use core\forms\match\ChemicalEntomophageMatchForm;
use core\repositories\match\ChemicalEntomophageMatchRepository;

class ChemicalEntomophageMatchService
{
    /** @var ChemicalEntomophageMatchRepository */
    protected $chemicalEntomophageMatches;

    /**
     * ChemicalEntomophageMatchService constructor
     * @var ChemicalEntomophageMatchRepository
     */
    public function __construct(ChemicalEntomophageMatchRepository $chemicalEntomophageMatches)
    {
        $this->chemicalEntomophageMatches = $chemicalEntomophageMatches;
    }

    public function find($id, $chemical_id, $entomophage_id): ?ChemicalEntomophageMatch
    {
        return $this->chemicalEntomophageMatches->find($id, $chemical_id, $entomophage_id);
    }

    public function findByFuture($chemical_id, $entomophage_id, $name): ?ChemicalEntomophageMatch
    {
        return $this->chemicalEntomophageMatches->findByFuture($chemical_id, $entomophage_id, $name);
    }

    /**
     * @return ChemicalEntomophageMatch[]
     */
    public function findAll(): array
    {
        return $this->chemicalEntomophageMatches->findAll();
    }

    public function create(ChemicalEntomophageMatchForm $form): ChemicalEntomophageMatch
    {
        $chemicalEntomophageMatch = ChemicalEntomophageMatch::create(
            $form->chemical_id,
            $form->entomophage_id,
            $form->match_id
        );
        $this->chemicalEntomophageMatches->save($chemicalEntomophageMatch);
        return $chemicalEntomophageMatch;
    }

    public function edit($id, $chemical_id, $entomophage_id, ChemicalEntomophageMatchForm $form): void
    {
        $chemicalEntomophageMatch = $this->chemicalEntomophageMatches->get($id, $chemical_id, $entomophage_id);
        $chemicalEntomophageMatch->edit(
            $form->chemical_id,
            $form->entomophage_id,
            $form->match_id
        );
        $this->chemicalEntomophageMatches->save($chemicalEntomophageMatch);
    }

    public function remove($id, $chemical_id, $entomophage_id): void
    {
        $chemicalEntomophageMatch = $this->chemicalEntomophageMatches->get($id, $chemical_id, $entomophage_id);
        $this->chemicalEntomophageMatches->delete($chemicalEntomophageMatch);
    }

    public function removeAll(): void
    {
        $this->chemicalEntomophageMatches->deleteAll();
    }

    public function truncate(): void
    {
        $this->chemicalEntomophageMatches->truncate();
    }

    public function insert($chemical_id, $entomophage_id, $match_id): bool
    {
        return $this->chemicalEntomophageMatches->insert(
            $chemical_id,
            $entomophage_id,
            $match_id
        );
    }

    public function getOrInsert($chemical_id, $entomophage_id, $match_id): ?ChemicalEntomophageMatch
    {
        $chemicalEntomophageMatch = $this->chemicalEntomophageMatches->findByFuture($chemical_id, $entomophage_id);
        if (!$chemicalEntomophageMatch instanceof ChemicalEntomophageMatch) {
            $this->insert($chemical_id, $entomophage_id, $match_id);
            return $this->chemicalEntomophageMatches->findByFuture($chemical_id, $entomophage_id);
        }
        return $chemicalEntomophageMatch;
    }

    public function getRepository(): ChemicalEntomophageMatchRepository
    {
        return $this->chemicalEntomophageMatches;
    }
}
