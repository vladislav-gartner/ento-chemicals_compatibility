<?php

namespace core\repositories\match;

use core\entities\Match\ChemicalEntomophageMatch;
use yii\base\Exception;

class ChemicalEntomophageMatchRepository
{
    public function get($id, $chemical_id, $entomophage_id): ChemicalEntomophageMatch
    {
        if (!$chemicalEntomophageMatch = ChemicalEntomophageMatch::findOne(['id' => $id, 'chemical_id' => $chemical_id, 'entomophage_id' => $entomophage_id])) {
            throw new \core\repositories\NotFoundException('ChemicalEntomophageMatch is not found.');
        }
        return $chemicalEntomophageMatch;
    }

    public function find($id, $chemical_id, $entomophage_id): ?ChemicalEntomophageMatch
    {
        return ChemicalEntomophageMatch::find()->andWhere(['id' => $id, 'chemical_id' => $chemical_id, 'entomophage_id' => $entomophage_id])->one();
    }

    /**
     * @return ChemicalEntomophageMatch[]
     */
    public function findAll(): array
    {
        return ChemicalEntomophageMatch::find()->all();
    }

    public function findByFuture($chemical_id, $entomophage_id): ?ChemicalEntomophageMatch
    {
        return ChemicalEntomophageMatch::findOne([
            'chemical_id' => $chemical_id,
            'entomophage_id' => $entomophage_id
        ],);
    }

    public function save(ChemicalEntomophageMatch $chemicalEntomophageMatch): void
    {
        if (!$chemicalEntomophageMatch->save()) {
            throw new \RuntimeException("Saving error. {$chemicalEntomophageMatch->plainErrors()}");
        }
    }

    public function delete(ChemicalEntomophageMatch $chemicalEntomophageMatch): void
    {
        if (!$chemicalEntomophageMatch->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        ChemicalEntomophageMatch::deleteAll();
    }

    public function insert($chemical_id, $entomophage_id, $match_id): bool
    {
        try {
            $model = new ChemicalEntomophageMatch();
            $model->chemical_id = $chemical_id;
            $model->entomophage_id = $entomophage_id;
            $model->match_id = $match_id;
            $model->save();
            return true;
        } catch (Exception $e) {
            throw new \RuntimeException('Insert error.');
        }
    }

    public function truncate(): void
    {
        ChemicalEntomophageMatch::clearAutoIncrement();
    }
}
