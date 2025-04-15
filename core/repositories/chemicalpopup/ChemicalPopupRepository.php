<?php

namespace core\repositories\chemicalpopup;

use core\entities\ChemicalPopup\ChemicalPopup;

class ChemicalPopupRepository
{
    public function get($id): ChemicalPopup
    {
        if (!$chemicalPopup = ChemicalPopup::findOne($id)) {
            throw new \core\repositories\NotFoundException('ChemicalPopup is not found.');
        }
        return $chemicalPopup;
    }

    public function find($id): ?ChemicalPopup
    {
        return ChemicalPopup::find()->andWhere(['id' => $id])->one();
    }

    /**
     * @return ChemicalPopup[]
     */
    public function findAll(): array
    {
        return ChemicalPopup::find()->all();
    }

    public function save(ChemicalPopup $chemicalPopup): void
    {
        if (!$chemicalPopup->save()) {
            throw new \RuntimeException("Saving error. {$chemicalPopup->plainErrors()}");
        }
    }

    public function delete(ChemicalPopup $chemicalPopup): void
    {
        if (!$chemicalPopup->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        ChemicalPopup::deleteAll();
    }

    public function truncate(): void
    {
        ChemicalPopup::clearAutoIncrement();
    }
}
