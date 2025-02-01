<?php

namespace core\entities\Compare;

use Yii;
use core\entities\Entomophage\Entomophage;
use core\entities\Entomophage\EntomophageQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "compare_entomophage_assignment".
 *
 * @property int $compare_id
 * @property int $entomophage_id
 *
 * @property Compare $compare
 * @property Entomophage $entomophage
 */
class CompareEntomophageAssignment extends ActiveRecord
{
    use ModelTrait;

    public static function tableName(): string
    {
        return 'compare_entomophage_assignment';
    }

    public static function create($compare_id, $entomophage_id): self
    {
        $compareEntomophageAssignment = new static();
        $compareEntomophageAssignment->compare_id = $compare_id;
        $compareEntomophageAssignment->entomophage_id = $entomophage_id;
        return $compareEntomophageAssignment;
    }

    public function edit($compare_id, $entomophage_id): void
    {
        $this->compare_id = $compare_id;
        $this->entomophage_id = $entomophage_id;
    }

    public function attributeLabels(): array
    {
        return [
            'compare_id' => Yii::t('app', 'Compare ID'),
            'entomophage_id' => Yii::t('app', 'Entomophage ID'),
        ];
    }

    public function getCompare()
    {
        return $this->hasOne(Compare::className(), ['id' => 'compare_id']);
    }

    public function getEntomophage()
    {
        return $this->hasOne(Entomophage::className(), ['id' => 'entomophage_id']);
    }

    public static function find(): CompareEntomophageAssignmentQuery
    {
        return new CompareEntomophageAssignmentQuery(get_called_class());
    }

    public function isFor($id): bool
    {
        return $this->entomophage_id == $id;
    }
}
