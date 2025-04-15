<?php

namespace core\services\chemicalpopup;

use core\entities\ChemicalPopup\ChemicalPopup;
use core\forms\chemicalpopup\ChemicalPopupForm;
use core\repositories\chemicalpopup\ChemicalPopupRepository;

class ChemicalPopupService
{
    /** @var ChemicalPopupRepository */
    protected $chemicalPopups;

    /**
     * ChemicalPopupService constructor
     * @var ChemicalPopupRepository
     */
    public function __construct(ChemicalPopupRepository $chemicalPopups)
    {
        $this->chemicalPopups = $chemicalPopups;
    }

    public function find($id): ?ChemicalPopup
    {
        return $this->chemicalPopups->find($id);
    }

    /**
     * @return ChemicalPopup[]
     */
    public function findAll(): array
    {
        return $this->chemicalPopups->findAll();
    }

    public function create(ChemicalPopupForm $form): ChemicalPopup
    {
        $chemicalPopup = ChemicalPopup::create(
            $form->chemical_id,
            $form->content,
            $form->status
        );
        $this->chemicalPopups->save($chemicalPopup);
        return $chemicalPopup;
    }

    public function edit($id, ChemicalPopupForm $form): void
    {
        $chemicalPopup = $this->chemicalPopups->get($id);
        $chemicalPopup->edit(
            $form->chemical_id,
            $form->content,
            $form->status
        );
        $this->chemicalPopups->save($chemicalPopup);
    }

    public function remove($id): void
    {
        $chemicalPopup = $this->chemicalPopups->get($id);
        $this->chemicalPopups->delete($chemicalPopup);
    }

    public function removeAll(): void
    {
        $this->chemicalPopups->deleteAll();
    }

    public function truncate(): void
    {
        $this->chemicalPopups->truncate();
    }

    public function getRepository(): ChemicalPopupRepository
    {
        return $this->chemicalPopups;
    }
}
