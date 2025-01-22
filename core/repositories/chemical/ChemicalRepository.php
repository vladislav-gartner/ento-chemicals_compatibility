<?php

namespace core\repositories\chemical;

use core\entities\Chemical\Chemical;
use yii\base\Exception;

class ChemicalRepository
{
    public function get($id): Chemical
    {
        if (!$chemical = Chemical::findOne($id)) {
            throw new \core\repositories\NotFoundException('Chemical is not found.');
        }
        return $chemical;
    }

    public function getByName($name): Chemical
    {
        if (!$chemical = Chemical::findOne(['name' => $name])) {
            throw new \core\repositories\NotFoundException('Chemical is not found.');
        }
        return $chemical;
    }

    public function find($id): ?Chemical
    {
        return Chemical::find()->andWhere(['id' => $id])->one();
    }

    /**
     * @return Chemical[]
     */
    public function findAll(): array
    {
        return Chemical::find()->all();
    }

    public function findByName($name): ?Chemical
    {
        return Chemical::findOne(['name' => $name]);
    }

    public function save(Chemical $chemical): void
    {
        if (!$chemical->save()) {
            throw new \RuntimeException("Saving error. {$chemical->plainErrors()}");
        }
    }

    public function delete(Chemical $chemical): void
    {
        if (!$chemical->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        Chemical::deleteAll();
    }

    public function insert($name, $status): bool
    {
        try {
            $model = new Chemical();
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
        Chemical::clearAutoIncrement();
    }
}
