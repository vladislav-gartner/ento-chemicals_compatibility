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

    public function find($id): ?ChemicalEntomophageMatch
    {
        return $this->chemicalEntomophageMatches->find($id);
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

    public function edit($id, ChemicalEntomophageMatchForm $form): void
    {
        $chemicalEntomophageMatch = $this->chemicalEntomophageMatches->get($id);
        $chemicalEntomophageMatch->edit(
            $form->chemical_id,
            $form->entomophage_id,
            $form->match_id
        );
        $this->chemicalEntomophageMatches->save($chemicalEntomophageMatch);
    }

    public function remove($id): void
    {
        $chemicalEntomophageMatch = $this->chemicalEntomophageMatches->get($id);
        $this->chemicalEntomophageMatches->delete($chemicalEntomophageMatch);
    }

    public function removeAll(): void
    {
        $this->chemicalEntomophageMatches->deleteAll();
    }

    public function getRepository(): ChemicalEntomophageMatchRepository
    {
        return $this->chemicalEntomophageMatches;
    }
}
