<?php

namespace core\repositories\ingredient;

use core\entities\Ingredient\Ingredient;
use yii\base\Exception;

class IngredientRepository
{
    public function get($id): Ingredient
    {
        if (!$ingredient = Ingredient::findOne($id)) {
            throw new \core\repositories\NotFoundException('Ingredient is not found.');
        }
        return $ingredient;
    }

    public function getByName($name): Ingredient
    {
        if (!$ingredient = Ingredient::findOne(['name' => $name])) {
            throw new \core\repositories\NotFoundException('Ingredient is not found.');
        }
        return $ingredient;
    }

    public function find($id): ?Ingredient
    {
        return Ingredient::find()->andWhere(['id' => $id])->one();
    }

    /**
     * @return Ingredient[]
     */
    public function findAll(): array
    {
        return Ingredient::find()->all();
    }

    public function findByName($name): ?Ingredient
    {
        return Ingredient::findOne(['name' => $name]);
    }

    public function save(Ingredient $ingredient): void
    {
        if (!$ingredient->save()) {
            throw new \RuntimeException("Saving error. {$ingredient->plainErrors()}");
        }
    }

    public function delete(Ingredient $ingredient): void
    {
        if (!$ingredient->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        Ingredient::deleteAll();
    }

    public function insert($name, $status): bool
    {
        try {
            $model = new Ingredient();
            $model->name = $name;
            $model->status = $status;
            $model->save();
            return true;
        } catch (Exception $e) {
            throw new \RuntimeException('Insert error.');
        }
    }

    public function truncate(): void
    {
        Ingredient::clearAutoIncrement();
    }
}
