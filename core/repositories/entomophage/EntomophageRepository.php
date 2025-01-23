<?php

namespace core\repositories\entomophage;

use core\entities\Entomophage\Entomophage;
use yii\base\Exception;

class EntomophageRepository
{
    public function get($id): Entomophage
    {
        if (!$entomophage = Entomophage::findOne($id)) {
            throw new \core\repositories\NotFoundException('Entomophage is not found.');
        }
        return $entomophage;
    }

    public function getByName($name): Entomophage
    {
        if (!$entomophage = Entomophage::findOne(['name' => $name])) {
            throw new \core\repositories\NotFoundException('Entomophage is not found.');
        }
        return $entomophage;
    }

    public function find($id): ?Entomophage
    {
        return Entomophage::find()->andWhere(['id' => $id])->one();
    }

    /**
     * @return Entomophage[]
     */
    public function findAll(): array
    {
        return Entomophage::find()->all();
    }

    public function findByName($name): ?Entomophage
    {
        return Entomophage::findOne(['name' => $name]);
    }

    public function save(Entomophage $entomophage): void
    {
        if (!$entomophage->save()) {
            throw new \RuntimeException("Saving error. {$entomophage->plainErrors()}");
        }
    }

    public function delete(Entomophage $entomophage): void
    {
        if (!$entomophage->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        Entomophage::deleteAll();
    }

    public function insert($name, $status): bool
    {
        try {
            $model = new Entomophage();
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
        Entomophage::clearAutoIncrement();
    }
}
