<?php

namespace core\repositories\match;

use core\entities\Match\ChemicalEntomophageMatch;

class ChemicalEntomophageMatchRepository
{
    public function get($id): ChemicalEntomophageMatch
    {
        if (!$chemicalEntomophageMatch = ChemicalEntomophageMatch::findOne($id)) {
            throw new \core\repositories\NotFoundException('ChemicalEntomophageMatch is not found.');
        }
        return $chemicalEntomophageMatch;
    }

    public function find($id): ?ChemicalEntomophageMatch
    {
        return ChemicalEntomophageMatch::find()->andWhere(['id' => $id])->one();
    }

    /**
     * @return ChemicalEntomophageMatch[]
     */
    public function findAll(): array
    {
        return ChemicalEntomophageMatch::find()->all();
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
}
