<?php

namespace core\repositories\entomophagepopup;

use core\entities\EntomophagePopup\EntomophagePopup;

class EntomophagePopupRepository
{
    public function get($id): EntomophagePopup
    {
        if (!$entomophagePopup = EntomophagePopup::findOne($id)) {
            throw new \core\repositories\NotFoundException('EntomophagePopup is not found.');
        }
        return $entomophagePopup;
    }

    public function find($id): ?EntomophagePopup
    {
        return EntomophagePopup::find()->andWhere(['id' => $id])->one();
    }

    /**
     * @return EntomophagePopup[]
     */
    public function findAll(): array
    {
        return EntomophagePopup::find()->all();
    }

    public function save(EntomophagePopup $entomophagePopup): void
    {
        if (!$entomophagePopup->save()) {
            throw new \RuntimeException("Saving error. {$entomophagePopup->plainErrors()}");
        }
    }

    public function delete(EntomophagePopup $entomophagePopup): void
    {
        if (!$entomophagePopup->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        EntomophagePopup::deleteAll();
    }

    public function truncate(): void
    {
        EntomophagePopup::clearAutoIncrement();
    }
}
