<?php

namespace core\services\chemical;

use core\entities\Chemical\Chemical;
use core\forms\chemical\ChemicalForm;
use core\repositories\chemical\ChemicalRepository;
use core\repositories\ingredient\IngredientRepository;
use core\services\TransactionManager;

class ChemicalService
{
    /** @var ChemicalRepository */
    protected $chemicals;

    /** @var IngredientRepository */
    protected $ingredients;

    /** @var TransactionManager */
    protected $transaction;

    /**
     * ChemicalService constructor
     * @var ChemicalRepository
     * @var IngredientRepository
     * @var TransactionManager
     */
    public function __construct(
        ChemicalRepository $chemicals,
        IngredientRepository $ingredients,
        TransactionManager $transaction
    ) {
        $this->chemicals = $chemicals;
        $this->ingredients = $ingredients;
        $this->transaction = $transaction;
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

        $this->bindIngredients($form, $chemical);

        $this->transaction->wrap(function () use ($form, $chemical) {
            $this->chemicals->save($chemical);
        });
        return $chemical;
    }

    public function edit($id, ChemicalForm $form): void
    {
        $chemical = $this->chemicals->get($id);
        $chemical->edit(
            $form->name,
            $form->status
        );

        $this->transaction->wrap(function () use ($form, $chemical) {

            $chemical->revokeIngredients();
            $this->chemicals->save($chemical);

            $this->bindIngredients($form, $chemical);

            $this->chemicals->save($chemical);
        });
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

    public function bindIngredients(ChemicalForm $form, Chemical $chemical)
    {
        foreach ($form->ingredients->existing as $id) {
            $ingredient = $this->ingredients->get($id);
            $chemical->assignIngredient($ingredient->id);
        };
    }
}
