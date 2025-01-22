<?php

namespace core\services\chemical;

use core\entities\Chemical\Chemical;
use core\forms\chemical\ChemicalForm;
use core\repositories\chemical\ChemicalRepository;

class ChemicalService
{
    /** @var ChemicalRepository */
    protected $chemicals;

    /**
     * ChemicalService constructor
     * @var ChemicalRepository
     */
    public function __construct(ChemicalRepository $chemicals)
    {
        $this->chemicals = $chemicals;
    }

    public function find($id): ?Chemical
    {
        return $this->chemicals->find($id);
    }

    /**
     * @return Chemical[]
     */
    public function findAll(): array
    {
        return $this->chemicals->findAll();
    }

    public function create(ChemicalForm $form): Chemical
    {
        $chemical = Chemical::create(
            $form->name,
            $form->status
        );
        $this->chemicals->save($chemical);
        return $chemical;
    }

    public function edit($id, ChemicalForm $form): void
    {
        $chemical = $this->chemicals->get($id);
        $chemical->edit(
            $form->name,
            $form->status
        );
        $this->chemicals->save($chemical);
    }

    public function remove($id): void
    {
        $chemical = $this->chemicals->get($id);
        $this->chemicals->delete($chemical);
    }

    public function removeAll(): void
    {
        $this->chemicals->deleteAll();
    }

    public function truncate(): void
    {
        $this->chemicals->truncate();
    }

    public function insert($name, $status): bool
    {
        return $this->chemicals->insert(
            $name,
            $status
        );
    }

    public function getOrInsert($name, $status): ?Chemical
    {
        $chemical = $this->chemicals->findByName($name);
        if (!$chemical instanceof Chemical) {
            $this->insert($name, $status);
            return $this->chemicals->findByName($name);
        }
        return $chemical;
    }

    public function getRepository(): ChemicalRepository
    {
        return $this->chemicals;
    }
}
