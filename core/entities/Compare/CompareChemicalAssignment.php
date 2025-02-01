<?php

namespace core\entities\Compare;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Chemical\ChemicalQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "compare_chemical_assignment".
 *
 * @property int $compare_id
 * @property int $chemical_id
 *
 * @property Compare $compare
 * @property Chemical $chemical
 */
class CompareChemicalAssignment extends ActiveRecord
{
    use ModelTrait;

    public static function tableName(): string
    {
        return 'compare_chemical_assignment';
    }

    public static function create($compare_id, $chemical_id): self
    {
        $compareChemicalAssignment = new static();
        $compareChemicalAssignment->compare_id = $compare_id;
        $compareChemicalAssignment->chemical_id = $chemical_id;
        return $compareChemicalAssignment;
    }

    public function edit($compare_id, $chemical_id): void
    {
        $this->compare_id = $compare_id;
        $this->chemical_id = $chemical_id;
    }

    public function attributeLabels(): array
    {
        return [
            'compare_id' => Yii::t('app', 'Compare ID'),
            'chemical_id' => Yii::t('app', 'Chemical ID'),
        ];
    }

    public function getCompare()
    {
        return $this->hasOne(Compare::className(), ['id' => 'compare_id']);
    }

    public function getChemical()
    {
        return $this->hasOne(Chemical::className(), ['id' => 'chemical_id']);
    }

    public static function find(): CompareChemicalAssignmentQuery
    {
        return new CompareChemicalAssignmentQuery(get_called_class());
    }

    public function isFor($id): bool
    {
        return $this->chemical_id == $id;
    }
}
