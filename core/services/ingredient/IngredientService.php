<?php

namespace core\services\ingredient;

use core\entities\Ingredient\Ingredient;
use core\forms\ingredient\IngredientForm;
use core\repositories\ingredient\IngredientRepository;

class IngredientService
{
    /** @var IngredientRepository */
    protected $ingredients;

    /**
     * IngredientService constructor
     * @var IngredientRepository
     */
    public function __construct(IngredientRepository $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    public function find($id): ?Ingredient
    {
        return $this->ingredients->find($id);
    }

    /**
     * @return Ingredient[]
     */
    public function findAll(): array
    {
        return $this->ingredients->findAll();
    }

    public function create(IngredientForm $form): Ingredient
    {
        $ingredient = Ingredient::create(
            $form->name,
            $form->status
        );
        $this->ingredients->save($ingredient);
        return $ingredient;
    }

    public function edit($id, IngredientForm $form): void
    {
        $ingredient = $this->ingredients->get($id);
        $ingredient->edit(
            $form->name,
            $form->status
        );
        $this->ingredients->save($ingredient);
    }

    public function remove($id): void
    {
        $ingredient = $this->ingredients->get($id);
        $this->ingredients->delete($ingredient);
    }

    public function removeAll(): void
    {
        $this->ingredients->deleteAll();
    }

    public function truncate(): void
    {
        $this->ingredients->truncate();
    }

    public function insert($name, $status): bool
    {
        return $this->ingredients->insert(
            $name,
            $status
        );
    }

    public function getOrInsert($name, $status): ?Ingredient
    {
        $ingredient = $this->ingredients->findByName($name);
        if (!$ingredient instanceof Ingredient) {
            $this->insert($name, $status);
            return $this->ingredients->findByName($name);
        }
        return $ingredient;
    }

    public function getRepository(): IngredientRepository
    {
        return $this->ingredients;
    }
}
