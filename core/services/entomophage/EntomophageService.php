<?php

namespace core\services\entomophage;

use core\entities\Entomophage\Entomophage;
use core\forms\entomophage\EntomophageForm;
use core\repositories\entomophage\EntomophageRepository;

class EntomophageService
{
    /** @var EntomophageRepository */
    protected $entomophages;

    /**
     * EntomophageService constructor
     * @var EntomophageRepository
     */
    public function __construct(EntomophageRepository $entomophages)
    {
        $this->entomophages = $entomophages;
    }

    public function find($id): ?Entomophage
    {
        return $this->entomophages->find($id);
    }

    /**
     * @return Entomophage[]
     */
    public function findAll(): array
    {
        return $this->entomophages->findAll();
    }

    public function create(EntomophageForm $form): Entomophage
    {
        $entomophage = Entomophage::create(
            $form->name,
            $form->status
        );
        $this->entomophages->save($entomophage);
        return $entomophage;
    }

    public function edit($id, EntomophageForm $form): void
    {
        $entomophage = $this->entomophages->get($id);
        $entomophage->edit(
            $form->name,
            $form->status
        );
        $this->entomophages->save($entomophage);
    }

    public function remove($id): void
    {
        $entomophage = $this->entomophages->get($id);
        $this->entomophages->delete($entomophage);
    }

    public function removeAll(): void
    {
        $this->entomophages->deleteAll();
    }

    public function truncate(): void
    {
        $this->entomophages->truncate();
    }

    public function insert($name, $status): bool
    {
        return $this->entomophages->insert(
            $name,
            $status
        );
    }

    public function getOrInsert($name, $status): ?Entomophage
    {
        $entomophage = $this->entomophages->findByName($name);
        if (!$entomophage instanceof Entomophage) {
            $this->insert($name, $status);
            return $this->entomophages->findByName($name);
        }
        return $entomophage;
    }

    public function getRepository(): EntomophageRepository
    {
        return $this->entomophages;
    }
}
